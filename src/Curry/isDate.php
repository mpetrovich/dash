<?php

namespace Dash\Curry;

function isDate(/* $value */)
{
	return \Dash\currify('Dash\isDate', func_get_args());
}
