<?php

namespace Dash;

/**
 * Checks whether `$value` is an integer.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isInteger($value)
{
	return is_int($value);
}
