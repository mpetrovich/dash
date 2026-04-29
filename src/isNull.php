<?php

namespace Dash;

/**
 * Checks whether `$value` is null.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isNull(null);
	// === true
 */
function isNull($value)
{
	return is_null($value);
}
