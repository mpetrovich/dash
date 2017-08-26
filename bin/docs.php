#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use Dash\_;

$sourceDir = $argv[1];
$destFilepath = $argv[2];
buildDocs($sourceDir, $destFilepath);

function buildDocs($sourceDir, $destFilepath)
{
	$categories = _::chain(new FilesystemIterator($sourceDir))
		->map(function ($fileinfo) { return pathinfo($fileinfo)['filename']; })
		->reject(function ($name) { return $name === '' || $name[0] === '_'; })
		->map(function ($name) { return "src/$name/$name.php"; })
		->filter(function ($filepath) { return file_exists($filepath); })
		->map('createDoc')
		->groupBy('category', 'Other')
		->each(function ($docs) { return _::sort($docs, _::property('name')); })
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

function createDoc($filepath)
{
	$docblock = extractDocblock($filepath);
	$op = parseDocblock($docblock);

	$name = pathinfo($filepath)['filename'];
	$op->name = $name;

	$op->signature = extractFunctionSignature($filepath);

	return $op;
}

function extractDocblock($filepath)
{
	$content = file_get_contents($filepath);
	$matches = [];

	// Extracts docblock
	$hasDoc = preg_match('/\/\**\n([\s\S]+?)\*\//', $content, $matches);
	$docblock = $hasDoc ? $matches[1] : '';

	// Removes leading asterisks and whitespace
	$docblock = preg_replace('/^[ ]*\*[ ]*(.*)$/m', '$1', $docblock);
	$docblock = trim($docblock);

	return $docblock;
}

function extractFunctionSignature($filepath)
{
	$content = file_get_contents($filepath);
	$hasFunction = preg_match('/^function (\w+\([^\)]*\))$/m', $content, $matches);
	$signature = $hasFunction ? $matches[1] : '';
	return $signature;
}

function parseDocblock($docblock)
{
	$op = (object) [];
	$lines = explode("\n", $docblock);

	// Description
	$op->description = _::chain($lines)
		->takeWhile(function ($line) { return strpos($line, '@') === false; })
		->join("\n")
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
		->filter(function ($line) { return strpos($line, '@see') === 0; })
		->first()
		->thru(function ($line) {
			$matches = [];
			preg_match('/^@see\s+(.*)$/', $line, $matches);
			$aliases = $matches[1];
			return $aliases ? explode(', ', $aliases) : [];
		})
		->value();

	// Return type
	$op->returnType = _::chain($lines)
		->filter(function ($line) { return strpos($line, '@return') === 0; })
		->map(function ($line) {
			$matches = [];
			preg_match('/^@return\s+([\S]+)/', $line, $matches);
			$returnType = $matches[1];
			return $returnType;
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

function renderDoc($op)
{
	$aliases = $op->aliases ? sprintf(' / %s', implode(' / ', $op->aliases)) : '';

	if ($op->params) {
		$paramsTable = _::reduce($op->params, function ($output, $param) {
			$type = str_replace('|', '\|', $param->type);
			return $output . "`$param->name` | `$type` | $param->description\n";
		}, "Parameter | Type | Description\n--- | --- | :---\n");
	}
	else {
		$paramsTable = '';
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

	$returnType = $op->returnType ? ": {$op->returnType}" : '';

	return <<<END
{$op->name}$aliases
---
```php
{$op->signature}$returnType
```
{$op->description}

$paramsTable

$examples
END;
}

function renderCategory($docs, $category)
{
	$renderedDocs = _::chain($docs)
		->map('renderDoc')
		->join("\n")
		->value();

	return <<<END
$category
===

$renderedDocs

END;
}

function renderTableOfContents($categories)
{
	$list = _::chain($categories)
		->map(function ($ops, $category) {
			$opsList = _::chain($ops)
				->map(function ($op) {
					$aliases = implode(' / ', $op->aliases);
					$aliases = $op->aliases ? " / $aliases" : '';

					$slug = _::chain(array_merge([$op->name], $op->aliases))
						->map(Dash\ary('strtolower', 1))
						->join('--')
						->value();

					return "- [{$op->name}](#{$slug})$aliases";
				})
				->join("\n")
				->value();

			return <<<END
### $category
$opsList

END;
		})
		->join("\n")
		->value();

	return <<<END
Table of contents
===
$list
END;
}
