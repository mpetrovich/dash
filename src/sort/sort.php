<?php

namespace Dash;

function sort($iterable, $comparator = 'Dash\compare')
{
	$array = mapValues($iterable);
	uasort($array, $comparator);  // uasort() is an in-place sort
	return $array;
}
