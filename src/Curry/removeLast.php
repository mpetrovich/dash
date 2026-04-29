<?php

namespace Dash\Curry;

function removeLast(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\removeLast', func_get_args());
}
