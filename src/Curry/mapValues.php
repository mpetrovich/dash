<?php

namespace Dash\Curry;

function mapValues(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\mapValues', func_get_args());
}
