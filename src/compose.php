<?php

namespace Dash;

/**
 * Returns a new function that performs right-to-left function composition.
 *
 * For example, `compose(a, b, c)` will return a new function that performs `a(b(c()))`.
 * The last function can have any arity, but the rest must be unary.
 *
 * @see pipe()
 *
 * @param callable ...$fns
 * @return callable New function that composes `$fns` right-to-left
 *
 * @example
	$addOne = function ($v) {
		return $v + 1;
	};
	$triple = function ($v) {
		return $v * 3;
	};
	$square = function ($v) {
		return $v * $v;
	};

	$composed = Dash\compose($square, $triple, $addOne);
	$composed(1); // === 36
 *
 * @example Last function can accept multiple arguments
	$pow = function ($base, $exp) {
		return pow($base, $exp);
	};
	$addOne = function ($v) {
		return $v + 1;
	};
	$triple = function ($v) {
		return $v * 3;
	};

	$composed = Dash\compose($triple, $addOne, $pow);
	$composed(2, 3); // === 27
 */
function compose(callable ...$fns)
{
	return function (...$args) use ($fns) {
		$fns = array_reverse($fns);
		$first = first($fns);
		$rest = array_slice($fns, 1);

		$result = call_user_func($first, ...$args);
		foreach ($rest as $fn) {
			$result = call_user_func($fn, $result);
		}

		return $result;
	};
}
