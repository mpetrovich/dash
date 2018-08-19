<?php

namespace Dash\Curry;

function keyBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\keyBy', func_get_args());
}

function indexBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\keyBy', func_get_args());
}
