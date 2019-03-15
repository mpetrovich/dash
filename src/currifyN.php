<?php

namespace Dash;

/**
 * Creates a new, curried version of `$callable` where the first `$rotate` of `$totalArgs` arguments
 * are moved to the end of the arguments list.
 *
 * In essence, this takes a data-first function and returns a curryable data-last function.
 *
 * @see currify(), curry(), partial()
 *
 * @param callable $callable
 * @param integer $totalArgs Total number of arguments accepted by `$callable`
 * @param array $args (optional) Initial arguments to pass to the final curried function
 * @param integer $rotate (optional) The number of arguments to move from start to end; see Dash\rotate()
 * @return function|mixed
 */
function currifyN(callable $callable, $totalArgs, array $args = [], $rotate = 1)
{
	$curryable = function () use ($callable, $rotate) {
		return call_user_func_array($callable, rotate(func_get_args(), -$rotate));
	};

	$curried = call_user_func_array('Dash\curryN', [$curryable, $totalArgs]);

	return call_user_func_array($curried, $args);
}
