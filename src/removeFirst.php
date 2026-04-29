<?php

namespace Dash;

/**
 * Returns a new iterable with the first element matching `$predicate` removed.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional)
 * @return array
 *
 * @example
	Dash\removeFirst([1, 2, 1, 3], function ($n) { return $n === 1; });
	// === [2, 1, 3]
 */
function removeFirst($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$array = toArray($iterable);
	$wasIndexed = isIndexedArray($array);
	$found = find($array, $predicate);

	if (is_null($found)) {
		return $wasIndexed ? array_values($array) : $array;
	}

	list($key) = $found;
	unset($array[$key]);

	return $wasIndexed ? array_values($array) : $array;
}
