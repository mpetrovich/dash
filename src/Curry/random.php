<?php

namespace Dash\Curry;

function random(/* $min, $max */)
{
	return \Dash\currify('Dash\random', func_get_args());
}
