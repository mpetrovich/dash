<?php

namespace Dash;

function curry($callable /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);

	$totalArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();

	if (count($args) >= $totalArgs) {
		return call_user_func_array($callable, $args);
	}
	else {
		return function () use ($callable, $args) {
			$curryArgs = array_merge([$callable], $args, func_get_args());
			return call_user_func_array('Dash\curry', $curryArgs);
		};
	}
}
