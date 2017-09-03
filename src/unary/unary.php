<?php

namespace Dash;

/**
 * Creates a new function that invokes `$callable` with a single argument and ignores the rest.
 *
 * @category Callable
 * @param callable $callable
 * @return callable New function
 *
 * @example
	$isNumeric = Dash\unary('is_numeric');

	Dash\map([1, 'a', 2.0, '3'], $isNumeric);
	// === [1, 2.0, '3']
 */
function unary(callable $callable)
{
	return ary($callable, 1);
}

/**
 * @codingStandardsIgnoreStart
 */
function _unary(/* callable */)
{
	return currify('Dash\unary', func_get_args());
}
