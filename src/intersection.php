<?php

namespace Dash;

/**
 * Returns the set of elements from `$iterable` whose values are present in each of the other iterables,
 * where values are compared using loose equality.
 *
 * The order, keys, and values of elements in the returned array are determined by `$iterable`.
 *
 * @see difference(), union()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable (variadic) Iterable against which all other passed iterables are compared
 * @return array
 *
 * @example With indexed arrays
	Dash\intersection(
		[1, 2, 3, 4, 5],
		['2', '4'],
		[4.0, 2.0]
	);
	// === [2, 4]
 *
 * @example With associative arrays
	Dash\intersection(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
		['a' => 2, 'b' => 4],
		['a' => 4, 'b' => 2]
	);
	// === ['b' => 2, 'd' => 4]
 */
function intersection($iterable /*, ...iterables */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$args = map(func_get_args(), 'Dash\toArray');
	$args[] = 'Dash\compare';
	$intersection = call_user_func_array('array_uintersect', $args);

	return isIndexedArray($iterable) ? array_values($intersection) : $intersection;
}
