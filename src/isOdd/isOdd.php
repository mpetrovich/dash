<?php

namespace Dash;

/**
 * Checks whether a number is odd.
 *
 * If a double is provided, only its truncated integer component is evaluated.
 *
 * @category Number
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

/**
 * @codingStandardsIgnoreStart
 */
function _isOdd(/* value */)
{
	return currify('Dash\isOdd', func_get_args());
}
