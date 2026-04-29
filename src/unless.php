<?php

namespace Dash;

/**
 * Creates a function that applies `$onFalse` when `$predicate` returns falsey; otherwise returns
 * the first argument unchanged.
 *
 * @see ifElse(), when()
 *
 * @param callable $predicate
 * @param callable $onFalse
 * @return callable
 */
function unless(callable $predicate, callable $onFalse)
{
	return ifElse($predicate, 'Dash\identity', $onFalse);
}
