<?php

namespace Dash\Curry;

function repeat(/* $count, $value */)
{
	return \Dash\currify('Dash\repeat', func_get_args());
}
