<?php

namespace Dash\Curry;

function isObject(/* $value */)
{
	return \Dash\currify('Dash\isObject', func_get_args());
}
