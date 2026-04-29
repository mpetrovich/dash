<?php

namespace Dash\Curry;

function findIndex(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findIndex', func_get_args());
}
