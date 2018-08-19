#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use Dash\_;

$sourceDir = $argv[1];
$destFilepath = $argv[2];
buildOps($sourceDir, $destFilepath);

function buildOps($sourceDir, $destFilepath)
{
	$categories = _::chain(new FilesystemIterator($sourceDir))
		->map(function ($fileinfo) { return pathinfo($fileinfo)['filename']; })
		->reject(function ($name) { return $name === '' || $name[0] === '_'; })
		->map(function ($name) { return "src/$name.php"; })
		->filter(function ($filepath) { return file_exists($filepath); })
		->map('createOp')
		->reject('isIncomplete')
		->groupBy('category', 'Other')
		->thru(function ($categories) {
			uasort($categories, function ($categoryA, $categoryB) {
				return count($categoryB) - count($categoryA);
			});
			return $categories;
		})
		->each(function ($ops) { return _::sort($ops, _::property('name')); })
		->value();

	_::chain($categories)
		->map('renderCategory')
		->join("\n")
		->thru(function ($renderedCategories) use ($categories) {
			$tableOfContents = renderTableOfContents($categories);
			return "$tableOfContents\n\n$renderedCategories";
		})
		->tap(function ($content) use ($destFilepath) { file_put_contents($destFilepath, $content); })
		->run();
}

function createOp($filepath)
{
	$docblock = extractDocblock($filepath);
	$op = parseDocblock($docblock);

	$name = pathinfo($filepath)['filename'];
	$op->name = $name;

	$op->slug = _::chain(array_merge([$op->name], $op->aliases))
		->map(Dash\ary('strtolower', 1))
		->join('--')
		->value();

	$op->signature = extractFunctionSignature($filepath);

	return $op;
}

function extractDocblock($filepath)
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
	$op->isIncomplete = _::chain($lines)
		->any(function ($line) { return strpos($line, '@incomplete') === 0; })
		->value();

	// Description
	$op->description = _::chain($lines)
		->takeWhile(function ($line) { return strpos($line, '@') === false; })
		->join("\n")
		->value();

	// Related
	$op->related = _::chain($lines)
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
		->value();

	// Category
	$op->category = _::chain($lines)
		->filter(function ($line) { return strpos($line, '@category') === 0; })
		->map(function ($line) {
			$matches = [];
			preg_match('/^@category\s+(.*)$/', $line, $matches);
			$category = $matches[1];
			return $category;
		})
		->first()
		->value();

	// Alias
	$op->aliases = _::chain($lines)
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
	$op->return = _::chain($lines)
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
	$allParamLines = _::dropWhile($lines, function ($line) {
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
	$allExampleLines = _::dropWhile($lines, function ($line) {
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

	$categorySlug = strtolower($op->category);

	$related = _::chain((array) $op->related)
		->map(function ($op) {
			return "[$op](#$op->slug)";
		})
		->join(', ')
		->value();

	$related = $related ? "Related: $related" : '';

	if ($op->params) {
		$paramsTable = _::reduce($op->params, function ($output, $param) {
			$type = str_replace('|', '\|', $param->type);
			return $output . "`$param->name` | `$type` | $param->description\n";
		}, "Parameter | Type | Description\n--- | --- | :---\n");
	}
	else {
		$paramsTable = '';
	}

	if ($op->return) {
		$type = str_replace('|', '\|', $op->return->type);
		$description = $op->return->description;
		$returnTable = <<<END
**Returns** | `$type` | $description
END;
	}
	else {
		$returnTable = '';
	}

	$examples = _::chain($op->examples)
		->map(function ($example) {
			return <<<END
**Example:** {$example->description}
```php
{$example->content}
```
END;
		})
		->join("\n\n")
		->value();

	$returnType = $op->return->type ? ": {$op->return->type}" : '';

	return <<<END

{$op->name}$aliases
---
[Operations](#operations) › [$op->category](#$categorySlug)

```php
{$op->signature}$returnType
```
{$op->description}
$related

$paramsTable$returnTable

$examples

[↑ Top](#operations)
END;
}

function renderCategory($ops, $category)
{
	$renderedOps = _::chain($ops)
		->map('renderOp')
		->join("\n")
		->value();

	return <<<END
$category
===
$renderedOps

END;
}

function renderTableOfContents($categories)
{
	$renderedCategories = _::chain($categories)
		->map(function ($ops, $category) {
			$rows = _::chain($ops)
				->map(function ($op) {
					$returnType = $op->return->type ? ": {$op->return->type}" : '';
					$returnType = str_replace('|', '\\|', $returnType);
					$aliases = $op->aliases ? ' / ' . implode(' / ', $op->aliases) : '';
					return "[$op->name](#$op->slug)$aliases | `{$op->signature}{$returnType}`";
				})
				->join("\n")
				->value();

			return <<<END
$category
---
Operation | Signature
:--- | :---
$rows

END;
		})
		->join("\n")
		->value();

	return <<<END
Operations
===
Is there an operation you'd like to see? [Open an issue](https://github.com/nextbigsoundinc/dash/issues/new?labels=enhancement) or vote on an existing one.

$renderedCategories
END;
}
