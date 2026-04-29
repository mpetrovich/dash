<?php

namespace Dash;

/**
 * Checks whether `$value` is a finite number.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isFinite($value)
{
	if (!is_int($value) && !is_float($value)) {
		return false;
	}

	return is_int($value) || is_finite($value);
}
