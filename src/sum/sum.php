<?php

namespace Dash;

/**
 * Gets the sum of all element values in `$iterable`.
 *
 * @category Iterable: Statistics
 * @param iterable $iterable
 * @return numeric Zero if `$iterable` is empty
 *
 * @example
	sum([2, 3, 5, 8]);
	// === 18

	sum([]);
	// === 0
 */
function sum($iterable)
{
	assertType($iterable, 'iterable', __FUNCTION__);

	$sum = reduce($iterable, function ($sum, $value) {
		return $sum += $value;
	}, 0);

	return $sum;
}

/**
 * @codingStandardsIgnoreStart
 */
function _sum(/* iterable */)
{
	return currify('Dash\sum', func_get_args());
}
