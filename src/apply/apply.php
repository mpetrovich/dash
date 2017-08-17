<?php

namespace Dash;

/**
 * Invokes a callable with arguments passed as a list.
 * @todo Add $context parameter
 *
 * @category Function
 * @param callable $callable
 * @param array $args
 * @return mixed Return value of $callable
 *
 * @example
	$saveUser = function ($name, $email) { … };
	apply($saveUser, ['John', 'jdoe@gmail.com']);
 */
function apply($callable, $args)
{
	return call_user_func_array($callable, $args);
}
