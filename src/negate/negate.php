<?php

namespace Dash;

/**
 * Returns a new function that negates the return value of $predicate when invoked.
 *
 * @category Callable
 * @param callable $predicate
 * @return callable
 */
function negate($predicate)
{
	$negated = function () use ($predicate) {
		return !call_user_func_array($predicate, func_get_args());
	};

	return $negated;
}
