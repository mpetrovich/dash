<?php

namespace Dash;

/**
 * Gets a new array containing the sorted elements of `$iterable`.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $comparator (optional) Invoked with `($a, $b)` where `$a` and `$b` are values in `$iterable`;
 *                             `$comparator` should returns a number less than, equal to, or greater than zero
 *                             if `$a` is less than, equal to, or greater than `$b`, respectively
 * @return array New array of `$iterable` elements ordered by `$comparator`
 *
 * @example
	Dash\sort([4, 2, 3, 1]);
	// === [1, 2, 3, 4]

	Dash\sort(['a' => 3, 'b' => 1, 'c' => 2]);
	// === ['b' => 1, 'c' => 2, 'a' => 3]
 */
function sort($iterable, $comparator = 'Dash\compare')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$array = toArray($iterable);

	if (isIndexedArray($array)) {
		usort($array, $comparator);
	}
	else {
		uasort($array, $comparator);
	}

	return $array;
}
