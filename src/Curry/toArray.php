<?php

namespace Dash\Curry;

function toArray(/* $value */)
{
	return \Dash\currify('Dash\toArray', func_get_args());
}
