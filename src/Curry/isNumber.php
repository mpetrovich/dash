<?php

namespace Dash\Curry;

function isNumber(/* $value */)
{
	return \Dash\currify('Dash\isNumber', func_get_args());
}
