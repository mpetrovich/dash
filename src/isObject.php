<?php

namespace Dash;

/**
 * Checks whether `$value` is an object.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isObject(new \stdClass());
	// === true
 */
function isObject($value)
{
	return is_object($value);
}
