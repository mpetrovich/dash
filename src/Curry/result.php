<?php

namespace Dash\Curry;

function result(/* $path, $default, $input */)
{
	return \Dash\currify('Dash\result', func_get_args());
}
