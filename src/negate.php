<?php

namespace Dash;

/**
 * Creates a new function that negates the return value of `$predicate`.
 *
 * @param callable $predicate
 * @return callable New function
 *
 * @example
	$isEven = function ($n) { return $n % 2 === 0; };
	$isOdd = Dash\negate($isEven);

	$isEven(3);  // === false
	$isOdd(3);   // === true
 */
function negate(callable $predicate)
{
	return function () use ($predicate) {
		return !call_user_func_array($predicate, func_get_args());
	};
}
