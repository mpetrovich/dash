<?php

namespace Dash\Curry;

function findLast(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findLast', func_get_args());
}
