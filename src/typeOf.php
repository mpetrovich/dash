<?php

namespace Dash;

/**
 * Gets a normalized type name for `$value`.
 *
 * Returns class names for objects.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return string
 */
function typeOf($value)
{
	if (is_object($value)) {
		return get_class($value);
	}

	return gettype($value);
}
