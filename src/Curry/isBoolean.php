<?php

namespace Dash\Curry;

function isBoolean(/* $value */)
{
	return \Dash\currify('Dash\isBoolean', func_get_args());
}
