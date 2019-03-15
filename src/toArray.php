<?php

namespace Dash;

/**
 * Gets an array representation of `$value`.
 *
 * @param mixed $value
 * @return array Empty array if `$value` is not iterable
 *
 * @example
	Dash\toArray((object) ['a' => 1, 'b' => 2]);
	// === ['a' => 1, 'b' => 2]

	Dash\toArray(new FilesystemIterator(__DIR__));
	// === [ SplFileInfo, SplFileInfo, ... ]
 */
function toArray($value)
{
	if (isType($value, ['Traversable', 'stdClass'])) {
		$array = [];
		foreach ($value as $key => $val) {
			$array[$key] = is_object($val) ? clone $val : $val;
		}
	}
	else {
		$array = (array) $value;
	}

	return $array;
}
