<?php

namespace Dash;

/**
 * Checks whether `$value` is scalar.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isScalar('text');
	// === true

	Dash\isScalar([]);
	// === false
 */
function isScalar($value)
{
	return is_scalar($value);
}
