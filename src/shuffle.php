<?php

namespace Dash;

/**
 * Returns a new array with values from `$iterable` in randomized order.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @alias randomize
 *
 * @example
	$xs = Dash\shuffle([1, 2, 3, 4, 5]);  // permutation of the input
 */
function shuffle($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = values($iterable);
	\shuffle($values);
	return $values;
}

function randomize()
{
	return call_user_func_array('Dash\shuffle', func_get_args());
}
