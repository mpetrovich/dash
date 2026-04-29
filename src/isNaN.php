<?php

namespace Dash;

/**
 * Checks whether `$value` is NaN.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isNaN(NAN);
	// === true
 */
function isNaN($value)
{
	return is_float($value) && is_nan($value);
}
