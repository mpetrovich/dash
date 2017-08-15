<?php

namespace Dash;

function where($iterable, $properties)
{
	$matches = matches($properties);
	$results = [];

	foreach ($iterable as $key => $value) {
		if ($matches($value)) {
			$results[$key] = $value;
		}
	}

	return $results;
}
