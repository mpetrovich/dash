<?php

namespace Dash;

/**
 * Combines parallel iterables into tuples (arrays of values), one tuple per index position.
 *
 * The length of the result is the length of the shortest iterable (truncated).
 *
 * @param iterable|stdClass|null ...$iterables
 * @return array|iterable A list of tuples; each tuple's elements are drawn from each iterable at the same logical position.
 *
 * @example
	Dash\zip([1, 2, 3], [10, 20, 30]);
	// === [[1, 10], [2, 20], [3, 30]]

	Dash\zip([1, 2], [10, 20, 99]);
	// === [[1, 10], [2, 20]]
 *
 * @example With no arguments
	Dash\zip();
	// === []
 */
function zip(/* ...$iterables */)
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
			return \Dash\Generator\zip(...$args);
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

	$minLen = min($lengths);
	$out = [];

	for ($i = 0; $i < $minLen; $i++) {
		$row = [];
		foreach ($arrays as $arr) {
			$row[] = $arr[$i];
		}
		$out[] = $row;
	}

	return $out;
}
