<?php

namespace Dash\Curry;

function omitBy(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\omitBy', func_get_args());
}
