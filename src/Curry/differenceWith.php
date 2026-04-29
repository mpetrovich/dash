<?php

namespace Dash\Curry;

function differenceWith(/* $other, $comparator, $iterable */)
{
	return \Dash\currify('Dash\differenceWith', func_get_args());
}
