<?php

namespace Dash;

/**
 * @category Function
 * @param callable $callable
 * @param array $args
 * @return mixed
 */
function currify($callable, array $args = [])
{
	$curryable = function () use ($callable) {
		return call_user_func_array($callable, rotate(func_get_args(), -1));
	};

	$totalArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();
	$curried = call_user_func_array('Dash\curryN', [$curryable, $totalArgs]);

	return call_user_func_array($curried, $args);
}
