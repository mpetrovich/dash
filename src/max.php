<?php

namespace Dash;

/**
 * Gets the maximum value of all elements in `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @example
	Dash\max([3, 8, 2, 5]);
	// === 8

	Dash\max([]);
	// === null
 */
function max($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (size($iterable) === 0) {
		return null;
	}

	$max = reduce($iterable, function ($max, $value) {
		return \max($max, $value);
	}, -INF);

	return $max;
}
