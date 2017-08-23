<?php

namespace Dash;

/**
 * Checks whether a number is even.
 *
 * If a double is provided, only its integer component is evaluated.
 *
 * @category Number
 * @param number $value
 * @return boolean
 *
 * @example
	isEven(3);  // === false
	isEven(4);  // === true
	isEven(4.7);  // === true
 */
function isEven($value)
{
	return $value % 2 === 0;
}
