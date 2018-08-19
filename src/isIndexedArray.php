<?php

namespace Dash;

/**
 * Checks whether `$value` is an array with sequential integer keys starting at 0.
 *
 * @category Iterable
 * @param mixed $value
 * @return boolean True if `$value` is an indexed array, false otherwise
 *
 * @example
	Dash\isIndexedArray(['a', 'b', 'c']);
	// === true

	Dash\isIndexedArray([1 => 'a', 'b', 'c']);
	// === false

	Dash\isIndexedArray(['a' => 1, 'b' => 2]);
	// === false
 */
function isIndexedArray($value)
{
	if (!is_array($value)) {
		return false;
	}

	$keys = array_keys($value);
	return array_keys($keys) === $keys;
}
