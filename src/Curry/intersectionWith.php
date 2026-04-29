<?php

namespace Dash\Curry;

function intersectionWith(/* $other, $comparator, $iterable */)
{
	return \Dash\currify('Dash\intersectionWith', func_get_args());
}
