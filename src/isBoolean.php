<?php

namespace Dash;

/**
 * Checks whether `$value` is a boolean.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isBoolean($value)
{
	return is_bool($value);
}
