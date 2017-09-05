<?php

namespace Dash;

/**
 * Gets the value of the first element in `$iterable`.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @see head
 *
 * @example
	Dash\first(['a' => 'one', 'b' => 'two', 'c' => 'three']);
	// === 'one'

	Dash\first([]);
	// === null
 */
function first($iterable)
{
	assertType($iterable, ['iterable', 'stdClass'], __FUNCTION__);

	foreach ($iterable as $value) {
		return $value;
	}

	return null;
}

/**
 * @codingStandardsIgnoreStart
 */
function _first(/* iterable */)
{
	return currify('Dash\first', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function head()
{
	return call_user_func_array('Dash\first', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function _head(/* iterable */)
{
	return currify('Dash\first', func_get_args());
}
