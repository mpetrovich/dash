<?php

namespace Dash;

/**
 * Checks whether `$value` is a valid regular expression pattern string.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isRegExp('/^hello$/');
	// === true

	Dash\isRegExp('not a pattern');
	// === false
 */
function isRegExp($value)
{
	if (!is_string($value) || $value === '') {
		return false;
	}

	return @preg_match($value, '') !== false;
}
