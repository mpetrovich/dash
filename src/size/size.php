<?php

namespace Dash;

/**
 * Gets the number of items in `$value`.
 *
 * For iterables, this is the number of elements.
 * For strings, this is number of characters.
 *
 * @category Utility
 * @param iterable|string $value
 * @param string $encoding (optional) The character encoding of `$value` if it is a string;
 *                         see `mb_list_encodings()` for the list of supported encodings
 * @return integer Zero if `$value` is neither iterable nor a string
 *
 * @alias count
 *
 * @example
	Dash\size([1, 2, 3]);
	// === 3

	Dash\size('Beyoncé');
	// === 7
 */
function size($value, $encoding = 'UTF-8')
{
	if (is_array($value) || $value instanceof Countable) {
		$size = \count($value);
	}
	elseif (isType($value, ['iterable', 'stdClass'])) {
		$size = 0;
		foreach ($value as $value) {
			$size++;
		}
	}
	elseif (is_string($value)) {
		$size = mb_strlen($value, $encoding);
	}
	else {
		$size = 0;
	}

	return $size;
}

/**
 * @codingStandardsIgnoreStart
 */
function _size(/* value */)
{
	return currify('Dash\size', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function count()
{
	return call_user_func_array('Dash\size', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function _count(/* value */)
{
	return call_user_func_array('Dash\_size', func_get_args());
}
