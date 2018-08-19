<?php

namespace Dash\Curry;

function map(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\map', func_get_args());
}
