<?php

namespace Dash;

/**
 * Creates a function that invokes `$callable` only after it is called `$n` times.
 *
 * @category Functions & composition
 *
 * @param integer $n
 * @param callable $callable
 * @return callable
 */
function after($n, callable $callable)
{
	assertType($n, 'numeric', __FUNCTION__);

	$count = 0;

	return function () use (&$count, $n, $callable) {
		$count++;

		if ($count < $n) {
			return null;
		}

		return call_user_func_array($callable, func_get_args());
	};
}
