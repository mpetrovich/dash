<?php

namespace Dash;

/**
 * Checks whether `$value` is a float.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isFloat(1.0);
	// === true
 */
function isFloat($value)
{
	return is_float($value);
}
