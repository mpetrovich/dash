<?php

namespace Dash;

/**
 * Creates a function that invokes `$callable` while called fewer than `$n` times.
 *
 * Once the threshold is reached, it returns the last computed result.
 *
 * @category Functions & composition
 *
 * @param integer $n
 * @param callable $callable
 * @return callable
 *
 * @example
	$fn = Dash\before(3, function ($x) { return $x + 1; });

	$fn(1);  // === 2
	$fn(2);  // === 3
	$fn(9);  // === 3  (threshold reached; returns last result)
 */
function before($n, callable $callable)
{
	assertType($n, 'numeric', __FUNCTION__);

	$count = 0;
	$result = null;

	return function () use (&$count, &$result, $n, $callable) {
		$count++;

		if ($count < $n) {
			$result = call_user_func_array($callable, func_get_args());
		}

		return $result;
	};
}
