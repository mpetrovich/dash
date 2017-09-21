<?php

namespace Dash;

/**
 * Invokes `$callable` with an inline list of arguments.
 *
 * Note: No curried function exists for this operation.
 *
 * @category Callable
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args Inline arguments to pass to `$callable`
 * @return mixed Return value of `$callable`
 *
 * @example
	$func = function ($time, $name) {
		return "Good $time, $name";
	};

	Dash\call($func, 'morning', 'John');
	// === 'Good morning, John'
 */
function call(callable $callable /*, ...args */)
{
	$args = array_slice(func_get_args(), 1);
	return call_user_func_array($callable, $args);
}
