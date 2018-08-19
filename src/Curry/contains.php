<?php

namespace Dash\Curry;

function contains(/* $target, $comparator, $iterable */)
{
	return \Dash\currify('Dash\contains', func_get_args());
}

function includes(/* $target, $comparator, $iterable */)
{
	return \Dash\currify('Dash\contains', func_get_args());
}
