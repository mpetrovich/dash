<?php

namespace Dash;

/**
 * Creates a new function that invokes `$callable` at most once.
 *
 * Subsequent calls return the result from the first invocation.
 *
 * @category Functions & composition
 *
 * @param callable $callable
 * @return callable
 *
 * @example
	$next = 0;
	$inc = Dash\once(function () use (&$next) {
		$next++;
		return $next;
	});

	$inc();  // === 1
	$inc();  // === 1
 */
function once(callable $callable)
{
	$called = false;
	$result = null;

	return function () use ($callable, &$called, &$result) {
		if (!$called) {
			$called = true;
			$result = call_user_func_array($callable, func_get_args());
		}

		return $result;
	};
}
