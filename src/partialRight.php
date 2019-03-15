<?php

namespace Dash;

/**
 * Creates a new function that will invoke `$callable` with the given arguments
 * and any others passed to the returned function.
 *
 * When calling `$callable`, arguments provided to `partial()` will be listed
 * AFTER those passed to the returned function.
 *
 * Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.
 *
 * @see partial(), curryRight()
 *
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args (optional, variadic) arguments to pass to `$callable`
 * @return callable
 *
 * @example
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};

	$greetMark = Dash\partialRight($greet, 'Mark');
	$greetJane = Dash\partialRight($greet, 'Jane');

	$greetMark('Hello');  // === 'Hello, Mark!'
	$greetJane('Howdy');  // === 'Howdy, Jane!'
 *
 * @example With a placeholder
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};

	$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
	$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

	$sayHello('Mark');  // === 'Hello, Mark!'
	$sayHowdy('Jane');  // === 'Howdy, Jane!'
 */
function partialRight($callable /*, ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = [];
		$runtimeArgs = func_get_args();

		while ($fixedArgs || $runtimeArgs) {
			if ($fixedArgs) {
				$fixedArg = array_pop($fixedArgs);
				$arg = ($fixedArg === _) ? array_pop($runtimeArgs) : $fixedArg;
				array_unshift($args, $arg);
			}
			elseif ($runtimeArgs) {
				$arg = array_pop($runtimeArgs);
				array_unshift($args, $arg);
			}
		}

		return call_user_func_array($callable, $args);
	};

	return $partial;
}
