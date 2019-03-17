#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

$sourceDir = $argv[1];
$destFilepath = $argv[2];
makeDocs($sourceDir, $destFilepath);

function makeDocs($sourceDir, $destFilepath)
{
	$ops = Dash\chain(new FilesystemIterator($sourceDir, FilesystemIterator::SKIP_DOTS))
		->reject(function ($fileinfo) { return $fileinfo->isDir(); })
		->map(function ($fileinfo) { return pathinfo($fileinfo)['filename']; })
		->reject(function ($name) { return $name[0] === '_'; })
		->map(function ($name) { return "src/$name.php"; })
		->filter(function ($filepath) { return file_exists($filepath); })
		->map('createOp')
		->reject('isIncomplete')
		->reject(['name', 'Dash'])
		->sort(function($op1, $op2) {
			return strnatcmp($op1->name, $op2->name);
		})
		->value();

	$opDocs = Dash\chain($ops)
		->map('renderOp')
		->join("\n")
		->value();

	$tableOfContents = renderTableOfContents($ops);

	file_put_contents($destFilepath, "$tableOfContents\n\n$opDocs");
}

function createOp($filepath)
{
	$docblock = extractDocblockString($filepath);
	$op = parseDocblock($docblock);

	$op->name = pathinfo($filepath)['filename'];
	$op->signature = extractFunctionSignature($filepath);

	$curriedFilepath = dirname($filepath) . '/Curry/' . basename($filepath);
	$op->curriedFilepath = file_exists($curriedFilepath) ? $curriedFilepath : null;

	$op->slug = Dash\chain(array_merge([$op->name], $op->aliases))
		->map(Dash\ary('strtolower', 1))
		->join('--')
		->value();

	return $op;
}

function extractDocblockString($filepath)
{
	$content = file_get_contents($filepath);
	$matches = [];

	// Extracts docblock
	$hasOp = preg_match('/\/\**\n([\s\S]+?)\*\//', $content, $matches);
	$docblock = $hasOp ? $matches[1] : '';

	// Removes leading asterisks and whitespace
	$docblock = preg_replace('/^[ ]*\*[ ]*(.*)$/m', '$1', $docblock);
	$docblock = trim($docblock);

	return $docblock;
}

function extractFunctionSignature($filepath)
{
	$content = file_get_contents($filepath);
	$hasFunction = preg_match('/^function &?(\w+\([^\)]*\))$/m', $content, $matches);
	$signature = $hasFunction ? $matches[1] : '';
	return $signature;
}

function parseDocblock($docblock)
{
	$op = (object) [];
	$lines = explode("\n", $docblock);

	// Incomplete
	$op->isIncomplete = Dash\chain($lines)
		->any(function ($line) { return strpos($line, '@incomplete') === 0; })
		->value();

	// Description
	$op->description = Dash\chain($lines)
		->takeWhile(function ($line) { return strpos($line, '@') === false; })
		->join("\n")
		->value();

	// Related
	$op->related = Dash\chain($lines)
		->filter(function ($line) { return strpos($line, '@see') === 0; })
		->map(function ($line) {
			$matches = [];
			preg_match('/^@see\s+(.*)$/', $line, $matches);
			$related = explode(', ', $matches[1]);
			return $related;
		})
		->reduce(function ($flattened, $related) {
			return array_merge($flattened, $related);
		}, [])
		->map(function ($opName) {
			return str_replace('()', '', $opName);
		})
		->value();

	// Alias
	$op->aliases = Dash\chain($lines)
		->filter(function ($line) { return strpos($line, '@alias') === 0; })
		->first()
		->thru(function ($line) {
			$matches = [];
			preg_match('/^@alias\s+(.*)$/', $line, $matches);
			$aliases = $matches[1];
			return $aliases ? explode(', ', $aliases) : [];
		})
		->value();

	// Return value
	$op->return = Dash\chain($lines)
		->filter(function ($line) { return strpos($line, '@return') === 0; })
		->map(function ($line) {
			$matches = [];
			preg_match('/^@return\s+([\S]+)\s*(.*)?/', $line, $matches);
			$type = $matches[1];
			$description = $matches[2];
			return (object) [
				'type' => $type,
				'description' => $description,
			];
		})
		->first()
		->value();

	// Parameters
	$allParamLines = Dash\dropWhile($lines, function ($line) {
		return strpos($line, '@param') !== 0;
	});

	for ($op->params = []; $allParamLines;) {
		$matches = [];
		$isMatch = preg_match('/^@param\s+([\S]+)\s+([\S]+)\s*(.*)$/', array_shift($allParamLines), $matches);

		if (!$isMatch) {
			continue;
		}

		list($type, $name, $description) = array_slice($matches, 1);
		$descriptionLines = (array) $description;

		while ($description && $allParamLines && strpos($allParamLines[0], '@') !== 0) {
			$descriptionLine = ltrim(array_shift($allParamLines));
			$descriptionLines[] = $descriptionLine;
		}

		$op->params[] = (object) [
			'type' => $type,
			'name' => $name,
			'description' => implode(' ', $descriptionLines),
		];
	}

	// Examples
	$allExampleLines = Dash\dropWhile($lines, function ($line) {
		return strpos($line, '@example') !== 0;
	});

	for ($op->examples = []; $allExampleLines;) {
		$description = str_replace('@example', '', array_shift($allExampleLines));
		$description = trim($description);

		$exampleLines = [];
		while ($allExampleLines && strpos($allExampleLines[0], '@example') !== 0) {
			$exampleLine = array_shift($allExampleLines);
			$exampleLine = preg_replace('/^\t/', '', $exampleLine);
			$exampleLines[] = $exampleLine;
		}

		$op->examples[] = (object) [
			'description' => $description,
			'content' => implode("\n", $exampleLines),
		];
	}

	return $op;
}

function renderOp($op)
{
	$aliases = $op->aliases ? sprintf(' / %s', implode(' / ', $op->aliases)) : '';

	$related = Dash\chain((array) $op->related)
		->map(function ($opName) {
			return "`$opName()`";
		})
		->join(', ')
		->value();

	$related = $related ? "See also: $related" : '';

	if ($op->params) {
		$paramsTable = Dash\reduce($op->params, function ($output, $param) {
			$type = str_replace('|', '\|', $param->type);
			return $output . rtrim("`$param->name` | `$type` | $param->description") . "\n";
		}, "Parameter | Type | Description\n--- | --- | :---\n");
	}
	else {
		$paramsTable = '';
	}

	if ($op->return) {
		$type = str_replace('|', '\|', $op->return->type);
		$description = $op->return->description ? " {$op->return->description}" : '';
		$returnTable = <<<END
**Returns** | `$type` |$description
END;
	}
	else {
		$returnTable = '';
	}

	$examples = Dash\chain($op->examples)
		->map(function ($example) {
			$description = $example->description ? " {$example->description}" : '';
			return <<<END
**Example:**{$description}
```php
{$example->content}
```
END;
		})
		->join("\n\n")
		->value();

	$returnType = $op->return->type ? ": {$op->return->type}" : '';

	if ($op->curriedFilepath) {
		$signature = extractFunctionSignature($op->curriedFilepath);
		$signature = preg_replace('#/\* (.+) \*/#', '$1', $signature);  // Removes wrapping /* comment */
		$curriedSignature = "\n\n" . "# Curried: (all parameters required)\n" . "Curry\\" . $signature;
	}
	else {
		$curriedSignature = '';
	}

	return <<<END

{$op->name}$aliases
---
$related

```php
{$op->signature}$returnType{$curriedSignature}
```
{$op->description}

$paramsTable$returnTable

$examples

[↑ Top](#operations)
END;
}

function renderTableOfContents($ops)
{
	$opSummaries = Dash\chain($ops)
		->sort(function($op1, $op2) {
			return strnatcmp($op1->name, $op2->name);
		})
		->map(function ($op) {
			$returnType = $op->return->type ? ": {$op->return->type}" : '';
			$returnType = str_replace('|', '\\|', $returnType);
			$aliases = $op->aliases ? ' / ' . implode(' / ', $op->aliases) : '';
			return "[$op->name](#$op->slug)$aliases | `{$op->signature}{$returnType}`";
		})
		->join("\n")
		->value();

	return <<<END
Operations
===
Is there an operation you'd like to see? [Open an issue](https://github.com/mpetrovich/dash/issues/new?labels=enhancement) or vote on an existing one.

Operation | Signature
:--- | :---
$opSummaries
END;
}
