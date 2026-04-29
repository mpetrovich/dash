<?php

namespace Dash\Curry;

function isArray(/* $value */)
{
	return \Dash\currify('Dash\isArray', func_get_args());
}
