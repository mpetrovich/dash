<?php

namespace Dash\Curry;

function findLastValue(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findLastValue', func_get_args());
}
