<?php

namespace Dash;

/**
 * Returns a new array containing the unique values, in order, of all arguments.
 *
 * Iterable keys are preseved.
 *
 * @category Collection
 * @param iterable $iterables,...
 * @return array
 *
 * @example
	intersection(
		[1, 3, 5, 8],
		[1, 2, 3, 4]
	);  // === [1, 3, 5, 8, 2, 4]
 */
function union(/* ...iterables */)
{
	$values = map(func_get_args(), 'Dash\values');
	$merged = call_user_func_array('array_merge', $values);
	$union = values(array_unique($merged));
	return $union;
}
