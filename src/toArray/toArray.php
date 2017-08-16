<?php

namespace Dash;

function toArray($value)
{
	if ($value instanceof \DirectoryIterator) {
		// iterator_to_array() doesn't work as expected with DirectoryIterator
		// https://bugs.php.net/bug.php?id=49755
		$array = [];
		foreach ($value as $key => $val) {
			$array[$key] = is_object($val) ? clone $val : $val;
		}
	}
	elseif ($value instanceof \Traversable) {
		$array = iterator_to_array($value);
	}
	else {
		$array = (array) $value;
	}

	return $array;
}
