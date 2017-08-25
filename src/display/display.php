<?php

namespace Dash;

/**
 * Prints a value.
 *
 * @category Utility
 * @param mixed $value
 * @return mixed $value
 *
 * @example
	display([1, 2, 3]);
	// echoes:
	Array
	(
		[0] => 1
		[1] => 2
		[2] => 3
	)
 */
function display($value)
{
	print_r($value);  // @codingStandardsIgnoreLine
	return $value;
}
