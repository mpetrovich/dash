<?php

namespace Dash\Curry;

function has(/* $path, $input */)
{
	return \Dash\currify('Dash\has', func_get_args());
}
