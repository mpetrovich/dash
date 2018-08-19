<?php

namespace Dash\Curry;

function groupBy(/* $iteratee, $defaultGroup, iterable */)
{
	return \Dash\currify('Dash\groupBy', func_get_args());
}
