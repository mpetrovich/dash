<?php

namespace Dash\Curry;

function custom(/* $name */)
{
	return \Dash\currify('Dash\custom', func_get_args());
}
