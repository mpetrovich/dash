<?php

namespace Dash;

function where($collection, $properties)
{
	$matches = matches($properties);
	$results = [];

	foreach ($collection as $key => $value) {
		if ($matches($value)) {
			$results[$key] = $value;
		}
	}

	return $results;
}
