<?php

namespace Dash\Curry;

function matchesAny(/* $properties, $iterable */)
{
	return \Dash\currify('Dash\matchesAny', func_get_args());
}
