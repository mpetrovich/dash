<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * Like `partialRight()`, arguments are applied in reverse order.
 *
 * Use `Dash\_` as a placeholder argument to replace with arguments from subsequent calls.
 *
 * @see curry(), partial()
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

	$goodMorning = Dash\curryRight($greet, 'Good morning');
	$goodMorning('Ms.', 'Mary');
	// === 'Good morning, Ms. Mary'

	$goodMorning = Dash\curryRight($greet, 'Good morning');
	$goodMorningSir = $goodMorning('Sir');
	$goodMorningSir('Peter');
	// === 'Good morning, Sir Peter'
 *
 * @example With placeholders
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name";
	};

	$greetMary = Dash\curryRight($greet, Dash\_, 'Ms.', 'Mary');
	$greetMary('Good morning');
	// === 'Good morning, Ms. Mary'

	$greetSir = Dash\curryRight($greet, Dash\_, 'Sir');
	$goodMorningSir = $greetSir('Good morning');
	$goodMorningSir('Peter');
	// === 'Good morning, Sir Peter'
 */
function curryRight(callable $callable /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);

	$numRequiredArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();

	$curryArgs = array_merge([$callable, $numRequiredArgs], $args);
	return call_user_func_array('Dash\curryRightN', $curryArgs);
}
