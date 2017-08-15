<?php

namespace Dash;

function findKey($iterable, $predicate)
{
	list($key, $value) = find($iterable, $predicate);
	return $key;
}
