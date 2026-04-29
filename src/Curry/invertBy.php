<?php

namespace Dash\Curry;

function invertBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\invertBy', func_get_args());
}
