<?php

namespace Dash\Curry;

function isFloat(/* $value */)
{
	return \Dash\currify('Dash\isFloat', func_get_args());
}
