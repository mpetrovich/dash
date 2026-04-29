<?php

namespace Dash\Curry;

function isFunction(/* $value */)
{
	return \Dash\currify('Dash\isFunction', func_get_args());
}
