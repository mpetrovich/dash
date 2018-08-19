<?php

namespace Dash\Curry;

function find(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\find', func_get_args());
}
