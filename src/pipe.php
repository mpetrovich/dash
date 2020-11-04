<?php

namespace Dash;

/**
 * Returns a new function that performs left-to-right function composition.
 *
 * For example, `pipe(a, b, c)` will return a new function that performs `c(b(a()))`.
 * The first function can have any arity, but the rest must be unary.
 *
 * @see compose()
 *
 * @param callable ...$fns
 * @return callable New function that composes `$fns` left-to-right
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

	$piped = Dash\pipe($addOne, $triple, $square);
	$piped(1); // === 36
 *
 * @example First function can accept multiple arguments
	$pow = function ($base, $exp) {
		return pow($base, $exp);
	};
	$addOne = function ($v) {
		return $v + 1;
	};
	$triple = function ($v) {
		return $v * 3;
	};

	$piped = Dash\pipe($pow, $addOne, $triple);
	$piped(2, 3); // === 27
 */
function pipe(callable ...$fns)
{
	return function (...$args) use ($fns) {
		$first = first($fns);
		$rest = array_slice($fns, 1);

		$result = call_user_func($first, ...$args);
		foreach ($rest as $fn) {
			$result = call_user_func($fn, $result);
		}

		return $result;
	};
}
