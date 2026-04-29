<?php

namespace Dash\Curry;

function pickBy(/* $predicate, $iterable */)
{
	return \Dash\currify('Dash\pickBy', func_get_args());
}
