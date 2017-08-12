<?php

namespace Dash;

function toArray($value)
{
	if ($value instanceof Traversable) {
		$array = iterator_to_array($value);
	}
	else {
		$array = (array) $value;
	}

	return $array;
}
