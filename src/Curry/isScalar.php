<?php

namespace Dash\Curry;

function isScalar(/* $value */)
{
	return \Dash\currify('Dash\isScalar', func_get_args());
}
