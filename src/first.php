<?php

namespace Dash;

/**
 * Gets the value of the first element in `$iterable`.
 *
 * @see take()
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @alias head
 *
 * @example
	Dash\first(['a' => 'one', 'b' => 'two', 'c' => 'three']);
	// === 'one'

	Dash\first([]);
	// === null
 */
function first($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	foreach ($iterable as $value) {
		return $value;
	}

	return null;
}

function head()
{
	return call_user_func_array('Dash\first', func_get_args());
}
