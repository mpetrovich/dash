<?php

namespace Dash;

/**
 * Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
 * otherwise, it returns a function that accepts the remaining number of required parameters.
 *
 * Like `partialRight()`, arguments are applied in reverse order.
 *
 * Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.
 *
 * @see curryN(), partialRight()
 *
 * @param callable $callable
 * @param integer $numRequiredArgs The number of parameters to require before calling `$callable`
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return function|mixed
 *
 * @example
	$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
		return "$greeting, $salutation $name$punctuation";
	};

	$greetMary = Dash\curryRightN($greet, 3, 'Mary');
	$greetMsMary = $greetMary('Ms.');
	$greetMsMary('Good morning');
	// === 'Good morning, Ms. Mary!

	$greetPeter = Dash\curryRightN($greet, 3, 'Peter');
	$greetSirPeter = $greetPeter('Sir');
	$greetSirPeter('Good morning');
	// === 'Good morning, Sir Peter!

 * @example With placeholders
	$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
		return "$greeting, $salutation $name$punctuation";
	};

	$goodMorning = Dash\curryRightN($greet, 3, 'Good morning', Dash\_, Dash\_);
	$goodMorningSir = $goodMorning('Sir', Dash\_);
	$goodMorningSir('Peter');
	// === 'Good morning, Sir Peter!

	$greetMs = Dash\curryRightN($greet, 3, 'Ms.', Dash\_);
	$goodMorningMs = $greetMs('Good morning', Dash\_);
	$goodMorningMs('Mary');
	// === 'Good morning, Ms. Mary!
 */
function curryRightN(callable $callable, $numRequiredArgs /*, ...args */)
{
	$args = func_get_args();
	array_shift($args);  // Removes $callable
	array_shift($args);  // Removes $numRequiredArgs

	$numNonPlaceholderArgs = chain($args)
		->reject(function ($arg) { return $arg === _; })
		->count()
		->value();

	if ($numNonPlaceholderArgs >= $numRequiredArgs) {
		$callableArgs = reject($args, function ($arg) { return $arg === _; });
		return call_user_func_array($callable, $callableArgs);
	}

	$curried = function () use ($callable, $numRequiredArgs, $args) {
		$nextArgs = func_get_args();
		$curryArgs = [];

		// Replaces placeholders from previous argument list with any available arguments
		while ($args || $nextArgs) {
			if ($args) {
				$arg = array_pop($args);
				$curryArg = ($arg === _ && $nextArgs) ? array_pop($nextArgs) : $arg;
			}
			elseif ($nextArgs) {
				$curryArg = array_pop($nextArgs);
			}
			array_unshift($curryArgs, $curryArg);
		}

		array_unshift($curryArgs, $numRequiredArgs);
		array_unshift($curryArgs, $callable);

		return call_user_func_array('Dash\curryRightN', $curryArgs);
	};

	return $curried;
}
