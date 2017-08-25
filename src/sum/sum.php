<?php

namespace Dash;

/**
 * Gets the sum of all values in $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return double
 *
 * @example
	sum([1, 2, 3, 4]);  // === 10
 */
function sum($iterable)
{
	$sum = reduce($iterable, function ($sum, $value) {
		return $sum += $value;
	}, 0);

	return $sum;
}
