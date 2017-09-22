<?php

namespace Dash;

/**
 * Creates a new function that will invoke `$callable` with the given arguments
 * and any others passed to the returned function.
 *
 * When calling `$callable`, arguments provided to `partial()` will be listed
 * BEFORE those passed to the returned function.
 *
 * Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.
 *
 * @category Callable
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return callable
 *
 * @example
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};

	$sayHello = Dash\partial($greet, 'Hello');
	$sayHowdy = Dash\partial($greet, 'Howdy');

	$sayHello('Mark');  // === 'Hello, Mark!'
	$sayHowdy('Jane');  // === 'Howdy, Jane!'
 *
 * @example With placeholders
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};

	$greetMark = Dash\partial($greet, Dash\_, 'Mark');
	$greetJane = Dash\partial($greet, Dash\_, 'Jane');

	$greetMark('Hello');  // === 'Hello, Mark!'
	$greetJane('Howdy');  // === 'Howdy, Jane!'
 */
function partial($callable /*, ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = [];
		$runtimeArgs = func_get_args();

		while ($fixedArgs || $runtimeArgs) {
			if ($fixedArgs) {
				$fixedArg = array_shift($fixedArgs);
				$args[] = ($fixedArg === _) ? array_shift($runtimeArgs) : $fixedArg;
			}
			elseif ($runtimeArgs) {
				$args[] = array_shift($runtimeArgs);
			}
		}

		return call_user_func_array($callable, $args);
	};

	return $partial;
}
