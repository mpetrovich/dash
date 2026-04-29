<?php

namespace Dash\Curry;

function unionWith(/* $other, $comparator, $iterable */)
{
	return \Dash\currify('Dash\unionWith', func_get_args());
}
