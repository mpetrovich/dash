<?php

namespace Dash\Curry;

function any(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\any', func_get_args());
}

function some(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\any', func_get_args());
}
