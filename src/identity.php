<?php

namespace Dash;

/**
 * Returns the first argument it receives.
 *
 * @category Utility
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

/**
 * @codingStandardsIgnoreStart
 */
function _identity(/* value */)
{
	return currify('Dash\identity', func_get_args());
}
