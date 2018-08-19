<?php

namespace Dash\Curry;

function reduce(/* $iteratee, $initial, $iterable */)
{
	return \Dash\currify('Dash\reduce', func_get_args());
}
