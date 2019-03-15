<?php

namespace Dash;

/**
 * Gets the sum of all element values in `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @return numeric Zero if `$iterable` is empty
 *
 * @example
	Dash\sum([2, 3, 5, 8]);
	// === 18

	Dash\sum([]);
	// === 0
 */
function sum($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$sum = reduce($iterable, function ($sum, $value) {
		return $sum += $value;
	}, 0);

	return $sum;
}
