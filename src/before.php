<?php

namespace Dash;

/**
 * Creates a function that invokes `$callable` while called fewer than `$n` times.
 *
 * Once the threshold is reached, it returns the last computed result.
 *
 * @param integer $n
 * @param callable $callable
 * @return callable
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
