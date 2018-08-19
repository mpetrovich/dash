<?php

namespace Dash\Curry;

function reject(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\reject', func_get_args());
}
