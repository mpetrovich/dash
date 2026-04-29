<?php

namespace Dash\Curry;

function dropWhile(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\dropWhile', func_get_args());
}
