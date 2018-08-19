<?php

namespace Dash\Curry;

function findKey(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findKey', func_get_args());
}
