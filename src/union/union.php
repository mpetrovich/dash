<?php

namespace Dash;

/**
 * Returns a new array containing the combined set of unique values, in order, of all provided iterables.
 *
 * Non-indexed keys are preseved, but duplicate keys will overwrite previous ones.
 *
 * This operation does not have a curried variant.
 *
 * @see intersection(), difference()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable (variadic) One or more iterables to merge
 * @return array
 *
 * @example With indexed arrays
	Dash\union(
		[1, 3, 5],
		[2, 4, 6],
		[7, 8]
	);
	// === [1, 3, 5, 2, 4, 6, 7, 8]
 *
 * @example With associative arrays
	Dash\union(
		['a' => 1, 'c' => 3],
		['b' => 2, 'd' => 4],
		['e' => 5, 'f' => 6]
	);
	// === ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6]
 */
function union($iterable /*, ...iterables */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = map(func_get_args(), 'Dash\toArray');
	$union = array_unique(call_user_func_array('array_merge', $values));

	return isIndexedArray($iterable) ? array_values($union) : $union;
}
