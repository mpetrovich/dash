<?php

namespace Dash\Curry;

function remove(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\remove', func_get_args());
}
