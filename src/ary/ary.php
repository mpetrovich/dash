<?php

namespace Dash;

/**
 * Creates a new function that invokes `$callable` with up to `$arity` arguments and ignores the rest.
 *
 * @category Callable
 * @param callable $callable
 * @param integer $arity Maximum number of arguments to accept
 * @return callable New function
 *
 * @example
	$isNumeric = Dash\ary('is_numeric', 1);

	Dash\filter([1, 2.0, '3', 'a'], $isNumeric);
	// === [1, 2.0, '3']
 */
function ary(callable $callable, $arity)
{
	assertType($arity, 'numeric', __FUNCTION__);

	return function () use ($callable, $arity) {
		$arity = \max(0, intval($arity));
		$args = array_slice(func_get_args(), 0, $arity);
		return call_user_func_array($callable, $args);
	};
}

/**
 * @codingStandardsIgnoreStart
 */
function _ary(/* arity, callable */)
{
	return currify('Dash\ary', func_get_args());
}
