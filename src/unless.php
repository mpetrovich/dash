<?php

namespace Dash;

/**
 * Creates a function that applies `$onFalse` when `$predicate` returns falsey; otherwise returns
 * the first argument unchanged.
 *
 * @category Functions & composition
 *
 * @see ifElse(), when()
 *
 * @param callable $predicate
 * @param callable $onFalse
 * @return callable
 *
 * @example
	$abs = Dash\unless(function ($n) { return $n >= 0; }, function ($n) { return -$n; });

	$abs(-4);
	// === 4
 */
function unless(callable $predicate, callable $onFalse)
{
	return ifElse($predicate, 'Dash\identity', $onFalse);
}
