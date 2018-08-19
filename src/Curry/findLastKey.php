<?php

namespace Dash\Curry;

function findLastKey(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findLastKey', func_get_args());
}
