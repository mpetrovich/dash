<?php

namespace Dash;

/**
 * Returns a new array whose values are the differences between successive values of `$iterable`.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\deltas([3, 8, 9, 9, 5, 13]);
	// === [0, 5, 1, 0, -4, 8]
 */
function deltas($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$deltas = [];
	$prev = null;

	foreach (values($iterable) as $value) {
		$deltas[] = $prev ? ($value - $prev) : 0;
		$prev = $value;
	}

	return $deltas;
}
