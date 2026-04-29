<?php

namespace Dash\Curry;

function indexOf(/* $value, $fromIndex, $comparator, $iterable */)
{
	return \Dash\currify('Dash\indexOf', func_get_args());
}
