<?php

namespace Dash;

/**
 * Returns a new array of the first $count elements of $iterable. Non-integer keys are preserved.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param integer $count If negative, all except the last $count elements will be returned
 * @return array
 *
 * @example
	take(['a', 'b', 'c', 'd', 'e'], 3);
	// === ['a', 'b', 'c']
 *
 * @example
	take(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'], 2);
	// === ['a' => 'one', 'b' => 'two']
 *
 * @example With a negative $count
	take(['a', 'b', 'c', 'd', 'e'], -2);
	// === ['a', 'b', 'c']
 */
function take($iterable, $count = 1)
{
	// @todo Reimplement with slice()
	return array_slice(toArray($iterable), 0, $count);
}
