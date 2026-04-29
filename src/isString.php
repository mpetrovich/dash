<?php

namespace Dash;

/**
 * Checks whether `$value` is a string.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isString('hello');
	// === true
 */
function isString($value)
{
	return is_string($value);
}
