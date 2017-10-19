<?php

namespace Dash;

/**
 * Checks whether an array value, object property, or method exists at `$key` within `$input`.
 *
 * @see getDirect()
 *
 * @category Utility
 * @param mixed $input
 * @param string $key Array offset, object property name, or method name
 * @return boolean
 *
 * @example
	Dash\hasDirect(['a' => 1, 'b' => 2], 'a');
	// === true

	Dash\hasDirect(['a' => 1, 'b' => 2], 'x');
	// === false

	Dash\hasDirect((object) ['a' => 1, 'b' => 2], 'a');
	// === true

	Dash\hasDirect(new DateTime(), 'getTimestamp');
	// === true
 */
function hasDirect($input, $key)
{
	return is_array($input) && array_key_exists($key, $input)
		|| is_object($input) && property_exists($input, $key)
		|| $input instanceof \ArrayAccess && $input->offsetExists($key)
		|| method_exists($input, $key);
}

/**
 * @codingStandardsIgnoreStart
 */
function _hasDirect(/* key, input */)
{
	return currify('Dash\hasDirect', func_get_args());
}
