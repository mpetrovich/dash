<?php

namespace Dash;

/**
 * Checks whether `$value` is an array.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isArray([]);
	// === true

	Dash\isArray(new \ArrayObject());
	// === false
 */
function isArray($value)
{
	return is_array($value);
}
