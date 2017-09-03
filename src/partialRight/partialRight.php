<?php

namespace Dash;

/**
 * Creates a function that invokes $callable with the given set of arguments appended to any others passed in.
 *
 * Pass Dash\_ as a placeholder to replace with call-time arguments.
 *
 * @category Callable
 * @param callable $callable
 * @return callable
 *
 * @example
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};
	$greetMark = Dash\partialRight($greet, 'Mark');
	$greetJane = Dash\partialRight($greet, 'Jane');

	$this->assertSame('Hello, Mark!', $greetMark('Hello'));
	$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));
 *
 * @example With a placeholder
	$greet = function ($greeting, $name) {
		return "$greeting, $name!";
	};
	$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
	$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

	$this->assertSame('Hello, Mark!', $sayHello('Mark'));
	$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));
 */
function partialRight($callable /* , ...args */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $callable

	$partial = function () use ($callable, $fixedArgs) {
		$args = [];
		$runtimeArgs = func_get_args();

		while ($fixedArgs || $runtimeArgs) {
			if ($fixedArgs) {
				$fixedArg = array_pop($fixedArgs);
				$arg = ($fixedArg === \Dash\_) ? array_pop($runtimeArgs) : $fixedArg;
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
