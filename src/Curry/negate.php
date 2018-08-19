<?php

namespace Dash\Curry;

function negate(/* $predicate */)
{
	return \Dash\currify('Dash\negate', func_get_args());
}
