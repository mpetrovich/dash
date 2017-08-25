<?php

namespace Dash;

/**
 * Returns the median value of an iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return mixed|null Null if $iterable is empty
 *
 * @example
	median([3, 8, 2, 5]);  // === 4
 */
function median($iterable)
{
	$size = size($iterable);

	if ($size === 0) {
		$median = null;
	}
	else {
		$sorted = values(sort($iterable));

		if ($size % 2 === 0) {
			// For an even number of values,
			// the median is the average of the middle two values
			$start = $size / 2 - 1;
			$end = $start + 1;
			$median = average(
				[
					at($sorted, $start),
					at($sorted, $end)
				]
			);
		}
		else {
			// For an odd number of values,
			// the median is the middle value
			$index = floor($size / 2);
			$median = at($sorted, $index);
		}
	}

	return $median;
}
