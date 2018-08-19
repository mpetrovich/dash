<?php

namespace Dash\Curry;

function all(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\all', func_get_args());
}

function every(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\all', func_get_args());
}
