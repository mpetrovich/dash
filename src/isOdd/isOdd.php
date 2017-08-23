<?php

namespace Dash;

/**
 * Checks whether a number is odd.
 *
 * If a double is provided, only its integer component is evaluated.
 *
 * @category Number
 * @param number $value
 * @return boolean
 *
 * @example
	isOdd(4);  // === false
	isOdd(3);  // === true
	isOdd(3.7);  // === true
 */
function isOdd($value)
{
	return !isEven($value);
}
