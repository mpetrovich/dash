<?php

namespace Dash\Curry;

function takeWhile(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\takeWhile', func_get_args());
}
