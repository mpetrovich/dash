<?php

namespace Dash\Curry;

function pluck(/* $path, $default, $iterable */)
{
	return \Dash\currify('Dash\pluck', func_get_args());
}
