<?php

namespace Dash\Curry;

function each(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\each', func_get_args());
}
