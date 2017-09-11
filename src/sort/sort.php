<?php

namespace Dash;

/**
 * Gets a new array containing the sorted elements of `$iterable`.
 * Keys are preserved.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable $comparator (optional) Invoked with `($a, $b)` where `$a` and `$b` are values in `$iterable`;
 *                             `$comparator` should returns a number less than, equal to, or greater than zero
 *                             if `$a` is less than, equal to, or greater than `$b`, respectively
 * @return array New array of `$iterable` elements ordered by `$comparator`
 *
 * @example
	Dash\sort([4, 2, 3, 1]);
	// === [1, 2, 3, 4]
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

/**
 * @codingStandardsIgnoreStart
 */
function _sort(/* comparator, iterable */)
{
	return currify('Dash\sort', func_get_args());
}
