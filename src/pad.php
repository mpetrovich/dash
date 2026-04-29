<?php

namespace Dash;

/**
 * Pads `$iterable` to `$length` by adding `$padValue` to both sides.
 *
 * If total padding is odd, the extra element is added to the right side.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $length
 * @param mixed $padValue (optional)
 * @return array
 *
 * @example
	Dash\pad([1, 2], 6, 0);
	// === [0, 0, 1, 2, 0, 0]
 */
function pad($iterable, $length, $padValue = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($length, 'numeric', __FUNCTION__);

	$values = values($iterable);
	$length = intval($length);
	$count = count($values);

	if ($length <= $count) {
		return $values;
	}

	$totalPad = $length - $count;
	$left = intdiv($totalPad, 2);
	$right = $totalPad - $left;

	return array_merge(
		array_fill(0, $left, $padValue),
		$values,
		array_fill(0, $right, $padValue)
	);
}
