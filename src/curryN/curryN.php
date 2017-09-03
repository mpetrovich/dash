<?php

namespace Dash;

/**
 * @category Function
 * @param callable $callable
 * @param numeric $totalArgs
 * @return mixed
 */
function curryN($callable, $totalArgs /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);
	array_shift($args);

	if (count($args) >= $totalArgs) {
		return call_user_func_array($callable, $args);
	}
	else {
		return function () use ($callable, $totalArgs, $args) {
			$curryArgs = array_merge([$callable, $totalArgs], $args, func_get_args());
			return call_user_func_array('Dash\curryN', $curryArgs);
		};
	}
}
