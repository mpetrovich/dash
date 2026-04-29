<?php

namespace Dash;

/**
 * Checks whether `$value` is an integer or float.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isNumber(3);
	// === true

	Dash\isNumber('3');
	// === false
 */
function isNumber($value)
{
	return is_int($value) || is_float($value);
}
