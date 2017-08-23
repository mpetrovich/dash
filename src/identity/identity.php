<?php

namespace Dash;

/**
 * Returns the first argument it receives.
 *
 * @category Utility
 * @param mixed $value
 * @return mixed $value itself
 *
 * @example
	$a = new ArrayObject();
	identity($a);  // === $a
 */
function identity($value)
{
	return $value;
}
