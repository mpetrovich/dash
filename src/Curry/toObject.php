<?php

namespace Dash\Curry;

function toObject(/* $value */)
{
	return \Dash\currify('Dash\toObject', func_get_args());
}
