<?php

namespace Dash\Curry;

function findLastIndex(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findLastIndex', func_get_args());
}
