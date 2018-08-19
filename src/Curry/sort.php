<?php

namespace Dash\Curry;

function sort(/* $comparator, $iterable */)
{
	return \Dash\currify('Dash\sort', func_get_args());
}
