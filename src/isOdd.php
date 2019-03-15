<?php

namespace Dash;

/**
 * Checks whether `$value` is an odd number.
 *
 * If a double is provided, only its truncated integer component is evaluated.
 *
 * @param numeric $value
 * @return boolean True if `$value` is an odd number, false otherwise
 *
 * @example
	Dash\isOdd(3);
	// === true

	Dash\isOdd(4);
	// === false

	Dash\isOdd(5.9);
	// === true

	Dash\isOdd('a');
	// === false
 */
function isOdd($value)
{
	return is_numeric($value) && ($value % 2 !== 0);
}
