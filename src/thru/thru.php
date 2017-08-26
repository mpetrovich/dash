<?php

namespace Dash;

/**
 * Invokes interceptor with ($iterable) and returns its result.
 *
 * @category Dash
 * @param iterable $iterable
 * @param callable $interceptor Invoked with ($iterable)
 * @return iterable Result of $interceptor($iterable)
 */
function thru($value, callable $interceptor)
{
	return call_user_func($interceptor, $value);
}
