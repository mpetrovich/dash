<?php

namespace Dash\Curry;

function identity(/* $value */)
{
	return \Dash\currify('Dash\identity', func_get_args());
}
