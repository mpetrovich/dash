<?php

namespace Dash;

/**
 * Creates a function that invokes $callable with the given set of arguments appended to any others passed in.
 *
 * @category Callable
 * @param callable $callable
 * @return callable
 *
 * @example
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};
	$greetMark = partial($greet, 'Mark');
	$greetJane = partial($greet, 'Jane');

	$greetMark('Hello');  // === 'Hello, Mark!'
	$greetJane('Howdy');  // === 'Howdy, Jane!'
 */
function partialRight($callable /* , ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = array_merge(func_get_args(), $fixedArgs);
		return call_user_func_array($callable, $args);
	};
	return $partial;
}
