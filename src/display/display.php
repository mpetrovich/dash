<?php

namespace Dash;

/**
 * Prints a value.
 *
 * @category Utility
 * @param mixed $value
 * @return mixed $value
 */
function display($value)
{
	print_r($value);  // @codingStandardsIgnoreLine
	return $value;
}
