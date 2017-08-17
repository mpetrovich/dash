<?php

namespace Dash;

function find($iterable, $predicate)
{
	foreach ($iterable as $key => $value) {
		$found = call_user_func($predicate, $value, $key, $iterable);
		if ($found) {
			return [$key, $value];
		}
	}

	return null;
}
