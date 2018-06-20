<?php

namespace Dash;

/**
 * Prints debugging information for one or more values.
 *
 * @category Utility
 * @param mixed $value (variadic) One or more values to debug
 * @return mixed The first argument
 *
 * @example
	$returned = Dash\debug([1, 2, 3], 'hello', 3.14);
	// $returned === [1, 2, 3]

	// Prints something like:
	array(3) {
	  [0] =>
	  int(1)
	  [1] =>
	  int(2)
	  [2] =>
	  int(3)
	}
	string(5) "hello"
	double(3.14)
 */
function debug($value /*, ...value */)
{
	ob_start();
	call_user_func_array('var_dump', func_get_args());
	$output = ob_get_clean();

	echo "$output\n";

	return $value;
}

/**
 * @codingStandardsIgnoreStart
 */
function _debug(/* ...value */)
{
	return currify('Dash\debug', func_get_args());
}
