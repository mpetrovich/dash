<?php

namespace Dash\Curry;

function isOdd(/* $value */)
{
	return \Dash\currify('Dash\isOdd', func_get_args());
}
