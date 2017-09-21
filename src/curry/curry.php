<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * @see partial()
 *
 * @category Callable
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return function|mixed
 *
 * @example
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name";
	};

	$goodMorning = Dash\curry($greet, 'Good morning');
	$goodMorning('Ms.', 'Mary');
	// === 'Good morning, Ms. Mary'

	$goodMorning = Dash\curry($greet, 'Good morning');
	$goodMorningSir = $goodMorning('Sir');
	$goodMorningSir('Peter');
	// === 'Good morning, Sir Peter'
 */
function curry(callable $callable /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);

	$numTotalArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();

	if (count($args) >= $numTotalArgs) {
		return call_user_func_array($callable, $args);
	}
	else {
		return function () use ($callable, $args) {
			$curryArgs = array_merge([$callable], $args, func_get_args());
			return call_user_func_array('Dash\curry', $curryArgs);
		};
	}
}
