<?php

namespace Dash\Curry;

function ary(/* $arity, $callable */)
{
	return \Dash\currify('Dash\ary', func_get_args());
}
