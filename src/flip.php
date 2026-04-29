<?php

namespace Dash;

/**
 * Creates a new function that swaps the first two arguments before invoking `$callable`.
 *
 * Any additional arguments are passed through unchanged.
 *
 * @param callable $callable
 * @return callable
 *
 * @example
	$subtract = function ($a, $b) {
		return $a - $b;
	};

	$reverseSubtract = Dash\flip($subtract);
	$reverseSubtract(2, 10);
	// === 8
 */
function flip(callable $callable)
{
	return function () use ($callable) {
		$args = func_get_args();

		if (count($args) > 1) {
			$tmp = $args[0];
			$args[0] = $args[1];
			$args[1] = $tmp;
		}

		return call_user_func_array($callable, $args);
	};
}
