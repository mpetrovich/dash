<?php

namespace Dash;

/**
 * Returns a new array with elements in reverse order. Non-integer keys are preserved.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @return array
 *
 * @example
	reverse(['a', 'b', 'c', 'd', 'e']);
	// === ['e', 'd', 'c', 'b', 'a']
 *
 * @example
	reverse(['a' => 'one', 'b' => 'two', 'c' => 'three']);
	// === ['c' => 'three', 'b' => 'two', 'a' => 'one']
 */
function reverse($iterable)
{
	return array_reverse(toArray($iterable));
}
