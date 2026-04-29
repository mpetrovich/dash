<?php

namespace Dash\Curry;

function isRegExp(/* $value */)
{
	return \Dash\currify('Dash\isRegExp', func_get_args());
}
