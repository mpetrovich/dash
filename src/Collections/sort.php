<?php

namespace Dash\Collections;

function sort($collection, $comparator = 'Dash\Functions\compare')
{
	$array = mapValues($collection);
	uasort($array, $comparator);  // uasort() is an in-place sort
	return $array;
}
