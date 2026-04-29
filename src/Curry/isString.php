<?php

namespace Dash\Curry;

function isString(/* $value */)
{
	return \Dash\currify('Dash\isString', func_get_args());
}
