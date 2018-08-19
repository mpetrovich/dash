<?php

namespace Dash;

/**
 * Checks whether `$value` is an even number.
 *
 * If a double is provided, only its truncated integer component is evaluated.
 *
 * @category Number
 * @param numeric $value
 * @return boolean True if `$value` is an even number, false otherwise
 *
 * @example
	Dash\isEven(3);
	// === false

	Dash\isEven(4);
	// === true

	Dash\isEven(4.9);
	// === true

	Dash\isEven('a');
	// === false
 */
function isEven($value)
{
	return is_numeric($value) && ($value % 2 === 0);
}
