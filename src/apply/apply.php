<?php

namespace Dash;

/**
 * @todo Add $context parameter
 *
 * @param callable $callable
 * @param array $args
 * @return mixed
 */
function apply($callable, $args)
{
	return call_user_func_array($callable, $args);
}
