<?php

namespace Dash;

function filter($iterable, $predicate)
{
	$filtered = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			$filtered[$key] = $value;
		}
	}

	return $filtered;
}
