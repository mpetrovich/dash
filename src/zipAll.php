<?php

namespace Dash;

/**
 * Like `zip()`, but uses the longest iterable length and pads missing positions with `null`.
 *
 * @param iterable|stdClass|null ...$iterables
 * @return array|iterable A list of tuples
 *
 * @example
	Dash\zipAll([1, 2], [10]);
	// === [[1, 10], [2, null]]
 */
function zipAll(/* ...$iterables */)
{
	$args = func_get_args();

	foreach ($args as $arg) {
		assertType($arg, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	}

	if (empty($args)) {
		return [];
	}

	foreach ($args as $arg) {
		if ($arg instanceof \Generator) {
			return \Dash\Generator\zipAll(...$args);
		}
	}

	$arrays = [];
	foreach ($args as $arg) {
		$arrays[] = values(toArray($arg));
	}

	$lengths = array_map('count', $arrays);
	if (empty($lengths)) {
		return [];
	}

	$maxLen = max($lengths);
	$out = [];

	for ($i = 0; $i < $maxLen; $i++) {
		$row = [];
		foreach ($arrays as $arr) {
			$row[] = array_key_exists($i, $arr) ? $arr[$i] : null;
		}
		$out[] = $row;
	}

	return $out;
}
