<?php

namespace Dash\Curry;

function at(/* $index, $default, $iterable */)
{
	return \Dash\currify('Dash\at', func_get_args());
}
