<?php

namespace Dash\Curry;

function partition(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\partition', func_get_args());
}
