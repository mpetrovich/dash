<?php

namespace Dash\Curry;

function reduceRight(/* $iteratee, $initial, $iterable */)
{
	return \Dash\currify('Dash\reduceRight', func_get_args());
}
