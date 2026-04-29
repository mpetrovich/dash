<?php

namespace Dash\Curry;

function removeFirst(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\removeFirst', func_get_args());
}
