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
	Dash\debug([1, 2, 3], 'hello', null);
	// === [1, 2, 3]

	// Prints:
	array (
	  0 => 1,
	  1 => 2,
	  2 => 3,
	)
	'hello'
	NULL
 *
 * @codeCoverageIgnore Due to output buffering
 */
function debug($value /*, ...value */)
{
	ob_start();
	each(func_get_args(), function ($arg) {
		var_export($arg);
		echo "\n";
	});
	echo ob_get_clean();
	return $value;
}
