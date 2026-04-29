<?php

namespace Dash\Curry;

function nth(/* $index, $default, $iterable */)
{
	return \Dash\currify('Dash\nth', func_get_args());
}
