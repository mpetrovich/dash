<?php

namespace Dash;

/**
 * Returns a new array whose values are the differences between subsequent elements of a iterable.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @return array
 *
 * @example
	deltas([3, 8, 9, 9, 5, 13]);  // === [0, 5, 1, 0, -4, 8]
 */
function deltas($iterable)
{
	$deltas = [];
	$prev = null;

	foreach ($iterable as $value) {
		$deltas[] = $prev ? ($value - $prev) : 0;
		$prev = $value;
	}

	return $deltas;
}
