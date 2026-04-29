<?php

namespace Dash\Curry;

function findWhere(/* $properties, $iterable */)
{
	return \Dash\currify('Dash\findWhere', func_get_args());
}
