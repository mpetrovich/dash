<?php

namespace Dash\Curry;

function findValue(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\findValue', func_get_args());
}
