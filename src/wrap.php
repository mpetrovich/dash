<?php

namespace Dash;

/**
 * Wraps `$callable` with `$wrapper`.
 *
 * The wrapper receives the original callable as its first argument.
 *
 * @param callable $callable
 * @param callable $wrapper
 * @return callable
 */
function wrap(callable $callable, callable $wrapper)
{
	return function () use ($callable, $wrapper) {
		$args = func_get_args();
		array_unshift($args, $callable);
		return call_user_func_array($wrapper, $args);
	};
}
