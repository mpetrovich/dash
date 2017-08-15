<?php

namespace Dash;

function findValue($iterable, $predicate)
{
	list($key, $value) = find($iterable, $predicate);
	return $value;
}
