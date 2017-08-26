<?php

namespace Dash;

const PLACEHOLDER = "\0\0";

/**
 * Creates a function that invokes $callable with the given set of arguments prepended to any others passed in.
 *
 * Pass Dash\PLACEHOLDER as a placeholder to replace with call-time arguments.
 *
 * @category Callable
 * @param callable $callable
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
 * @example With a placeholder
	$greet = function ($greeting, $salutation, $name) {
		return "$greeting, $salutation $name!";
	};
	$greetMr = Dash\partial($greet, Dash\PLACEHOLDER, 'Mr.');
	$greetMr('Hello', 'Mark');  // === 'Hello, Mr. Mark!'
 */
function partial($callable /* , ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = [];
		$runtimeArgs = func_get_args();

		while ($fixedArgs || $runtimeArgs) {
			if ($fixedArgs) {
				$fixedArg = array_shift($fixedArgs);
				$args[] = ($fixedArg === \Dash\PLACEHOLDER) ? array_shift($runtimeArgs) : $fixedArg;
			}
			elseif ($runtimeArgs) {
				$args[] = array_shift($runtimeArgs);
			}
		}

		return call_user_func_array($callable, $args);
	};

	return $partial;
}
