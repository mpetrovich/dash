<?php

namespace Dash;

/**
 * Checks whether `$value` is a finite number.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isFinite(1.5);
	// === true

	Dash\isFinite(INF);
	// === false
 */
function isFinite($value)
{
	if (!is_int($value) && !is_float($value)) {
		return false;
	}

	return is_int($value) || is_finite($value);
}
