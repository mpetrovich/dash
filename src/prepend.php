<?php

namespace Dash;

/**
 * Returns a new array with `$values` added to the beginning of `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @param mixed ...$values
 * @return array
 *
 * @alias unshift
 */
function prepend($iterable /* , ...$values */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = array_slice(func_get_args(), 1);
	return array_merge($values, values($iterable));
}

function unshift()
{
	return call_user_func_array('Dash\prepend', func_get_args());
}
