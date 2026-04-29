<?php

namespace Dash;

/**
 * Creates a function that applies `$onTrue` when `$predicate` returns truthy; otherwise returns
 * the first argument unchanged.
 *
 * @category Functions & composition
 *
 * @see ifElse(), unless()
 *
 * @param callable $predicate
 * @param callable $onTrue
 * @return callable
 */
function when(callable $predicate, callable $onTrue)
{
	return ifElse($predicate, $onTrue, 'Dash\identity');
}
