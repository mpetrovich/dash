<?php

namespace Dash;

/**
 * Returns a new iterable with the last element matching `$predicate` removed.
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional)
 * @return array
 */
function removeLast($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$array = toArray($iterable);
	$wasIndexed = isIndexedArray($array);
	$found = findLast($array, $predicate);

	if (is_null($found)) {
		return $wasIndexed ? array_values($array) : $array;
	}

	list($key) = $found;
	unset($array[$key]);

	return $wasIndexed ? array_values($array) : $array;
}
