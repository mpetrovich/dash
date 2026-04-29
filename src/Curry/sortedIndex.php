<?php

namespace Dash\Curry;

function sortedIndex(/* $value, $comparator, $iterable */)
{
	return \Dash\currify('Dash\sortedIndex', func_get_args());
}
