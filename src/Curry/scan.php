<?php

namespace Dash\Curry;

function scan(/* $iteratee, $initial, $iterable */)
{
	return \Dash\currify('Dash\scan', func_get_args());
}
