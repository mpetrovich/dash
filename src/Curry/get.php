<?php

namespace Dash\Curry;

function get(/* $path, $default, $input */)
{
	return \Dash\currify('Dash\get', func_get_args());
}
