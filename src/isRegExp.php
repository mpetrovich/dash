<?php

namespace Dash;

/**
 * Checks whether `$value` is a valid regular expression pattern string.
 *
 * @param mixed $value
 * @return boolean
 */
function isRegExp($value)
{
	if (!is_string($value) || $value === '') {
		return false;
	}

	return @preg_match($value, '') !== false;
}
