<?php

namespace Dash\Collections;

function toArray($collection)
{
	if (is_array($collection)) {
		return $collection;
	}

	$array = array();

	foreach ($collection as $key => $value) {
		$array[$key] = $value;
	}

	return $array;
}
