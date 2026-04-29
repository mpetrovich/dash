<?php

namespace Dash;

/**
 * Returns a new array of `$iterable` sorted by key.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\sortKeys(['z' => 1, 'a' => 2]);
	// === ['a' => 2, 'z' => 1]
 */
function sortKeys($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$array = toArray($iterable);
	ksort($array);
	return $array;
}
