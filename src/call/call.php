<?php

namespace Dash;

/**
 * @todo Add $context parameter
 *
 * @param callable $callable
 * @return mixed
 */
function call($callable)
{
	$args = array_slice(func_get_args(), 1);
	return call_user_func_array($callable, $args);
}
