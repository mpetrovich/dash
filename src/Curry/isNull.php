<?php

namespace Dash\Curry;

function isNull(/* $value */)
{
	return \Dash\currify('Dash\isNull', func_get_args());
}
