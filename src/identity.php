<?php

namespace Dash;

/**
 * Returns the first argument it receives.
 *
 * @param mixed $value
 * @return mixed `$value` unmodified
 *
 * @example
	$a = new ArrayObject();
	$b = Dash\identity($a);
	// $b === $a
 */
function identity($value)
{
	return $value;
}
