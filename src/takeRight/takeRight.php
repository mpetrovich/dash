<?php

namespace Dash;

/**
 * Returns a new array of the last $count elements of $iterable. Non-integer keys are preserved.
 *
 * @category Collection
 * @param iterable $iterable
 * @param integer $count If negative, all except the first $count elements will be returned
 * @return array
 *
 * @example
	takeRight(['a', 'b', 'c', 'd', 'e'], 3);
	// === ['c', 'd', 'e']
 *
 * @example
	takeRight(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'], 2);
	// === ['c' => 'three', 'd' => 'four']
 *
 * @example With a negative $count
	takeRight(['a', 'b', 'c', 'd', 'e'], -2);
	// === ['c', 'd', 'e']
 */
function takeRight($iterable, $count = 1)
{
	return reverse(take(reverse($iterable), $count));
}
