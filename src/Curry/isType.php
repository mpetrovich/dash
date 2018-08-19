<?php

namespace Dash\Curry;

function isType(/* $type, $value */)
{
	return \Dash\currify('Dash\isType', func_get_args());
}
