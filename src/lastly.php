<?php

namespace Dash;

/**
 * Creates a function that always runs `$onFinally` after `$fn` (try/finally semantics).
 *
 * @category Functions & composition
 *
 * @param callable $fn
 * @param callable $onFinally
 * @return callable
 */
function lastly(callable $fn, callable $onFinally)
{
	return function () use ($fn, $onFinally) {
		$args = func_get_args();

		try {
			return call_user_func_array($fn, $args);
		} finally {
			call_user_func_array($onFinally, $args);
		}
	};
}
