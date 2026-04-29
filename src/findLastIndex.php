<?php

namespace Dash;

/**
 * Returns the 0-based index of the last element for which `$predicate` returns truthy, or `-1` if none.
 *
 * Counts in forward iteration order (same indexing as `findIndex()`).
 *
 * @see findLast(), findLastKey(), findIndex()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) Same forms as `find()`.
 * @return integer
 *
 * @example
	Dash\findLastIndex([1, 2, 3, 4, 2], function ($v) { return $v === 2; });
	// === 4
 */
function findLastIndex($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return -1;
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$last = -1;
	$index = 0;

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$last = $index;
		}
		$index++;
	}

	return $last;
}
