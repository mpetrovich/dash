<?php

namespace Dash;

/**
 * Invokes a callable with arguments passed as individual parameters.
 * @todo Add $context parameter
 *
 * @category Function
 * @param callable $callable
 * @return mixed Return value of $callable
 *
 * @example
	$saveUser = function ($name, $email) { … };
	call($saveUser, 'John', 'jdoe@gmail.com');
 */
function call($callable /* , ...args */)
{
	$args = array_slice(func_get_args(), 1);
	return call_user_func_array($callable, $args);
}
