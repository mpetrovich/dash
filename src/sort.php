<?php

namespace Dash;

function sort($collection, $comparator = 'Dash\compare')
{
	$array = mapValues($collection);
	uasort($array, $comparator);  // uasort() is an in-place sort
	return $array;
}
