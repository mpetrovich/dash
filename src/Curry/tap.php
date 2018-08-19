<?php

namespace Dash\Curry;

function tap(/* $interceptor, $value */)
{
	return \Dash\currify('Dash\tap', func_get_args());
}
