<?php

namespace Dash;

/**
 * Gets a custom operation by name.
 *
 * @category Utility
 * @param string $name Name of the custom operation
 * @return function The custom operation
 *
 * @example
	_::setCustom('double', function ($n) { return $n * 2; });

	$double = Dash\custom('double');
	$double(3);
	// === 6

	_::chain([1, 2, 3])->map(Dash\custom('double'))->value();
	// === [2, 4, 6]
 */
function custom($name)
{
	return function () use ($name) {
		return call_user_func_array("Dash\\_::$name", func_get_args());
	};
}

/**
 * @codingStandardsIgnoreStart
 */
function _custom(/* name */)
{
	return currify('Dash\custom', func_get_args());
}
