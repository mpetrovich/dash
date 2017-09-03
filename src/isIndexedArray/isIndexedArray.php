<?php

namespace Dash;

/**
 * Returns whether $input is an array with sequential integer keys that start at 0.
 *
 * @category Iterable: Query
 * @param mixed $input
 * @return boolean
 *
 * @example
	isIndexedArray([1, 2, 3]);             // === true
	isIndexedArray(['a' => 1, 'b' => 2]);  // === false
 */
function isIndexedArray($input)
{
	if (!is_array($input)) {
		return false;
	}

	$keys = array_keys($input);
	return array_keys($keys) === $keys;
}
