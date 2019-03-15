<?php

namespace Dash;

/**
 * Gets the average value of all elements in `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @return double|null Null if `$iterable` is empty
 *
 * @alias mean
 *
 * @example
	Dash\average([2, 3, 5, 8]);
	// === 4.5
 */
function average($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$size = size($iterable);

	if ($size === 0) {
		return null;
	}

	return sum($iterable) / $size;
}

function mean()
{
	return call_user_func_array('Dash\average', func_get_args());
}
