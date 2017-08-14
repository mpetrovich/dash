<?php

namespace Dash;

function filter($collection, $predicate)
{
	$filtered = [];

	foreach ($collection as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			$filtered[$key] = $value;
		}
	}

	return $filtered;
}
