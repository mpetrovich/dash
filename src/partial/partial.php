<?php

namespace Dash;

/**
 * Creates a function that invokes $callable with the given set of arguments prepended to any others passed in.
 *
 * @category Callable
 * @param callable $callable
 * @return callable
 *
 * @example
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};
	$sayHello = partial($greet, 'Hello');
	$sayHowdy = partial($greet, 'Howdy');

	$sayHello('Mark');  // === 'Hello, Mark!'
	$sayHowdy('Jane');  // === 'Howdy, Jane!'
 */
function partial($callable /* , ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = array_merge($fixedArgs, func_get_args());
		return call_user_func_array($callable, $args);
	};
	return $partial;
}
