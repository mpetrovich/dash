<?php

namespace Dash\Curry;

function sortBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\sortBy', func_get_args());
}
