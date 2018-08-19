<?php

namespace Dash\Curry;

function apply(/* $callable, $args */)
{
	return \Dash\currify('Dash\apply', func_get_args(), 0);
}
