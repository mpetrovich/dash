<?php

namespace Dash\Curry;

function property(/* $default, $path */)
{
	return \Dash\currify('Dash\property', func_get_args());
}
