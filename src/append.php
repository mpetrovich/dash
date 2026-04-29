<?php

namespace Dash;

/**
 * Returns a new array with `$values` added to the end of `$iterable`.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param mixed ...$values
 * @return array
 *
 * @alias unpop
 *
 * @example
	Dash\append([1, 2], 3, 4);
	// === [1, 2, 3, 4]
 */
function append($iterable /* , ...$values */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = array_slice(func_get_args(), 1);
	return array_merge(values($iterable), $values);
}

function unpop()
{
	return call_user_func_array('Dash\append', func_get_args());
}
