<?php

namespace Dash;

/**
 * Checks whether `$value` is an integer or float.
 *
 * @param mixed $value
 * @return boolean
 */
function isNumber($value)
{
	return is_int($value) || is_float($value);
}
