<?php

namespace Dash;

/**
 * Returns the set of elements from `$iterable` whose values are not present in any of the other iterables,
 * where values are compared using loose equality.
 *
 * The order, keys, and values of elements in the returned array are determined by `$iterable`.
 *
 * @see intersection(), union()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable (variadic) Iterable against which all other passed iterables are compared
 * @return array
 *
 * @example With indexed arrays
	Dash\difference(
		[1, 2, 3, 4, 5],
		['2', 4],
		[3.0, 4]
	);
	// === [1, 5]
 *
 * @example With associative arrays
	Dash\difference(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
		['a' => '2', 'b' => 4],
		['a' => 3.0, 'b' => 4]
	);
	// === ['a' => 1, 'e' => 5]
 */
function difference($iterable /*, ...iterables */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$args = map(func_get_args(), 'Dash\toArray');
	$args[] = 'Dash\compare';
	$difference = call_user_func_array('array_udiff', $args);

	return isIndexedArray($iterable) ? array_values($difference) : $difference;
}
