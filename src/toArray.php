<?php

namespace Dash;

function toArray($collection)
{
	if (is_array($collection)) {
		return $collection;
	}

	$array = [];

	foreach ($collection as $key => $value) {
		$array[$key] = $value;
	}

	return $array;
}
