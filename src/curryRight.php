<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * Like `partialRight()`, arguments are applied in reverse order.
 *
 * Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.
 *
 * @see curry(), partial()
 *
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return function|mixed
 *
 * @example
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name";
	};

	$greetMary = Dash\curryRight($greet, 'Mary');
	$greetMsMary = $greetMary('Ms.');
	// === 'Good morning, Ms. Mary'

	$greetPeter = Dash\curryRight($greet, 'Peter');
	$greetSirPeter = $greetPeter('Sir');
	// === 'Good morning, Sir Peter'
 *
 * @example With placeholders
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name";
	};

	$goodMorning = Dash\curryRight($greet, 'Good morning', Dash\_, Dash\_);
	$goodMorningSir = $goodMorning('Sir', Dash\_);
	// === 'Good morning, Sir Peter'

	$greetMs = Dash\curryRight($greet, 'Ms.', Dash\_);
	$goodMorningMs = $greetMs('Good morning', Dash\_);
	// === 'Good morning, Ms. Mary'
 */
function curryRight(callable $callable /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);  // Removes $callable

	$numRequiredArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();

	$curryArgs = array_merge([$callable, $numRequiredArgs], $args);
	return call_user_func_array('Dash\curryRightN', $curryArgs);
}
