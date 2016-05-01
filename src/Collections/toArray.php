<?php

namespace Dash\Collections;

function toArray($collection)
{
	$array = array();

	foreach ($collection as $key => $value) {
		$array[$key] = $value;
	}

	return $array;
}
