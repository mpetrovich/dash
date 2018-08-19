<?php

namespace Dash\Curry;

function unary(/* $callable */)
{
	return \Dash\currify('Dash\unary', func_get_args());
}
