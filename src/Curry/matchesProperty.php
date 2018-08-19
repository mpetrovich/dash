<?php

namespace Dash\Curry;

function matchesProperty(/* $value, $comparator, $path */)
{
	return \Dash\currify('Dash\matchesProperty', func_get_args());
}
