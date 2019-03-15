<?php

namespace Dash;

/**
 * Creates a new function that invokes `$callable` with a single argument and ignores the rest.
 *
 * @param callable $callable
 * @return callable New function
 *
 * @example
	$isNumeric = Dash\unary('is_numeric');

	Dash\filter([1, 2.0, '3', 'a'], $isNumeric);
	// === [1, 2.0, '3']
 */
function unary(callable $callable)
{
	return ary($callable, 1);
}
