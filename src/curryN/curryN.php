<?php

namespace Dash;

/**
 * @category Callable
 * @param callable $callable
 * @param integer $totalArgs
 * @return mixed
 */
function curryN(callable $callable, $totalArgs /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);
	array_shift($args);

	if (count($args) >= $totalArgs) {
		return call_user_func_array($callable, array_slice($args, 0, $totalArgs));
	}
	else {
		return function () use ($callable, $totalArgs, $args) {
			$curryArgs = array_merge([$callable, $totalArgs], $args, func_get_args());
			return call_user_func_array('Dash\curryN', $curryArgs);
		};
	}
}
