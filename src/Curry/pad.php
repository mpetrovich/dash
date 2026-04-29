<?php

namespace Dash\Curry;

function pad(/* $length, $padValue, $iterable */)
{
	return \Dash\currify('Dash\pad', func_get_args());
}
