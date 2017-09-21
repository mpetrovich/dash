<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * @category Callable
 * @param callable $callable
 * @param integer $numRequiredArgs The number of parameters to require before calling `$callable`
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return function|mixed
 *
 * @example
	$greet = function ($greeting, $name, $salutation = 'Mr.') {
		return "$greeting, $salutation $name";
	};

	$goodMorningMr = Dash\curryN($greet, 2, 'Good morning');
	$goodMorningMr('Smith');
	// === 'Good morning, Mr. Smith'
 */
function curryN(callable $callable, $numRequiredArgs /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);
	array_shift($args);

	if (count($args) >= $numRequiredArgs) {
		return call_user_func_array($callable, array_slice($args, 0, $numRequiredArgs));
	}
	else {
		return function () use ($callable, $numRequiredArgs, $args) {
			$curryArgs = array_merge([$callable, $numRequiredArgs], $args, func_get_args());
			return call_user_func_array('Dash\curryN', $curryArgs);
		};
	}
}
