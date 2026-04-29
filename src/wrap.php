<?php

namespace Dash;

/**
 * Wraps `$callable` with `$wrapper`.
 *
 * The wrapper receives the original callable as its first argument.
 *
 * @category Functions & composition
 *
 * @param callable $callable
 * @param callable $wrapper
 * @return callable
 *
 * @example
	$logged = Dash\wrap(
		function ($x) { return $x + 1; },
		function ($fn, $x) {
			return 100 + call_user_func($fn, $x);
		}
	);

	$logged(1);
	// === 102
 */
function wrap(callable $callable, callable $wrapper)
{
	return function () use ($callable, $wrapper) {
		$args = func_get_args();
		array_unshift($args, $callable);
		return call_user_func_array($wrapper, $args);
	};
}
