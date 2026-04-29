<?php

namespace Dash\Curry;

function isNaN(/* $value */)
{
	return \Dash\currify('Dash\isNaN', func_get_args());
}
