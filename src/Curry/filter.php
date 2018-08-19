<?php

namespace Dash\Curry;

function filter(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\filter', func_get_args());
}
