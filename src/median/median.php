<?php

namespace Dash;

/**
 * Returns the median value of an iterable.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @example
	Dash\median([3, 2, 1, 5, 4]);
	// === 3

	Dash\median([3, 2, 1, 4]);
	// === 2.5
 */
function median($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$size = size($iterable);

	if ($size === 0) {
		return null;
	}

	$sorted = values(sort($iterable));

	if (isEven($size)) {
		// For an even number of values,
		// the median is the average of the middle two values
		$start = $size / 2 - 1;
		$end = $start + 1;
		$median = ($sorted[$start] + $sorted[$end]) / 2;
	}
	else {
		// For an odd number of values,
		// the median is the middle value
		$index = floor($size / 2);
		$median = $sorted[$index];
	}

	return $median;
}

/**
 * @codingStandardsIgnoreStart
 */
function _median(/* iterable */)
{
	return currify('Dash\median', func_get_args());
}
