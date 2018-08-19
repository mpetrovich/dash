<?php

namespace Dash\Curry;

function thru(/* $interceptor, $value */)
{
	return \Dash\currify('Dash\thru', func_get_args());
}
