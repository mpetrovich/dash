<?php

namespace Dash;

/**
 * Returns a new array containing values of $iterable that are present in all other arguments.
 *
 * Iterable keys are preseved.
 *
 * @category Iterable
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
