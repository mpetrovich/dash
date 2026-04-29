<?php

namespace Dash;

/**
 * Creates a function that routes arguments to `$onTrue` or `$onFalse` based on `$predicate`.
 *
 * @param callable $predicate
 * @param callable $onTrue
 * @param callable $onFalse
 * @return callable
 *
 * @example
	$fn = Dash\ifElse(
		function ($n) { return $n >= 0; },
		function ($n) { return "pos:$n"; },
		function ($n) { return "neg:$n"; }
	);
	$fn(2);   // === 'pos:2'
	$fn(-3);  // === 'neg:-3'
 */
function ifElse(callable $predicate, callable $onTrue, callable $onFalse)
{
	return function () use ($predicate, $onTrue, $onFalse) {
		$args = func_get_args();

		if (call_user_func_array($predicate, $args)) {
			return call_user_func_array($onTrue, $args);
		}

		return call_user_func_array($onFalse, $args);
	};
}
