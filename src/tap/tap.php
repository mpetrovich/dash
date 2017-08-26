<?php

namespace Dash;

/**
 * Invokes $interceptor with ($iterable) and returns $iterable.
 *
 * Note: Any changes to $iterable in $interceptor will not be persisted.
 *
 * @category Dash
 * @param iterable $iterable
 * @param callable $interceptor Invoked with ($iterable)
 * @return iterable $iterable
 */
function tap($iterable, callable $interceptor)
{
	call_user_func($interceptor, $iterable);
	return $iterable;
}
