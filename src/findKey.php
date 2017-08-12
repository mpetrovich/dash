<?php

namespace Dash;

function findKey($collection, $predicate)
{
	list($key, $value) = find($collection, $predicate);
	return $key;
}
