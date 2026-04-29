<?php

namespace Dash\Curry;

function isInteger(/* $value */)
{
	return \Dash\currify('Dash\isInteger', func_get_args());
}
