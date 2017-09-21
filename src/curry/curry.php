<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * Use `Dash\_` as a placeholder argument to replace with arguments from subsequent calls.
 *
 * @see curryN(), partial(), currify()
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
 *
 * @example With placeholders
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name";
	};

	$greetMary = Dash\curry($greet, Dash\_, 'Ms.', 'Mary');
	$greetMary('Good morning');
	// === 'Good morning, Ms. Mary'

	$greetSir = Dash\curry($greet, Dash\_, 'Sir');
	$goodMorningSir = $greetSir('Good morning');
	$goodMorningSir('Peter');
	// === 'Good morning, Sir Peter'
 */
function curry(callable $callable /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);

	$numRequiredArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();

	$numNonPlaceholderArgs = chain($args)
		->reject(_identical(_))
		->count()
		->value();

	if ($numNonPlaceholderArgs >= $numRequiredArgs) {
		$deferredArgs = array_slice($args, $numRequiredArgs);
		$callableArgs = [];

		// Replaces placeholders with arguments from the end, in order
		while ($args) {
			$arg = array_shift($args);
			$callableArgs[] = ($arg === _) ? array_shift($deferredArgs) : $arg;
		}

		return call_user_func_array($callable, $callableArgs);
	}

	return function () use ($callable, $args) {
		$nextArgs = func_get_args();
		$curryArgs = [$callable];

		// Replaces placeholders from previous argument list with any available arguments
		while ($args || $nextArgs) {
			if ($args) {
				$arg = array_shift($args);
				$curryArgs[] = ($arg === _ && $nextArgs) ? array_shift($nextArgs) : $arg;
			}
			elseif ($nextArgs) {
				$curryArgs[] = array_shift($nextArgs);
			}
		}

		return call_user_func_array('Dash\curry', $curryArgs);
	};
}
