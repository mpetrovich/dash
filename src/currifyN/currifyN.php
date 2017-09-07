<?php

namespace Dash;

/**
 * @category Callable
 * @param callable $callable
 * @param integer $totalArgs
 * @param array $args
 * @param numeric $rotate
 * @return mixed
 */
function currifyN(callable $callable, $totalArgs, array $args = [], $rotate = -1)
{
	$curryable = function () use ($callable, $rotate) {
		return call_user_func_array($callable, rotate(func_get_args(), $rotate));
	};

	$curried = call_user_func_array('Dash\curryN', [$curryable, $totalArgs]);

	return call_user_func_array($curried, $args);
}
