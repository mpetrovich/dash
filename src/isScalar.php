<?php

namespace Dash;

/**
 * Checks whether `$value` is scalar.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isScalar($value)
{
	return is_scalar($value);
}
