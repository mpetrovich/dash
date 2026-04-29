<?php

namespace Dash\Curry;

function mapKeys(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\mapKeys', func_get_args());
}
