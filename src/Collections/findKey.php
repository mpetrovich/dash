<?php

namespace Dash\Collections;

function findKey($collection, $predicate)
{
	list($key, $value) = find($collection, $predicate);
	return $key;
}
