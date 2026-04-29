<?php

namespace Dash\Curry;

function clamp(/* $lower, $upper, $number */)
{
	return \Dash\currify('Dash\clamp', func_get_args());
}
