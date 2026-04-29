<?php

namespace Dash\Curry;

function lastIndexOf(/* $value, $fromIndex, $comparator, $iterable */)
{
	return \Dash\currify('Dash\lastIndexOf', func_get_args());
}
