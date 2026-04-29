<?php

namespace Dash\Curry;

function isTraversable(/* $value */)
{
	return \Dash\currify('Dash\isTraversable', func_get_args());
}
