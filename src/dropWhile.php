<?php

namespace Dash;

/**
 * Returns a subset of `$iterable` that excludes elements from the beginning.
 *
 * Elements are dropped while `$predicate` returns truthy, then all remaining elements are kept.
 *
 * @category Collections & iterators
 *
 * @see takeWhile()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $predicate (optional) Invoked with `($value, $key, $iterable)` for each element
 * @return array|iterable
 *
 * @example
	Dash\dropWhile([2, 4, 6, 7, 8], 'Dash\isEven');
	// === [7, 8]
 */
function dropWhile($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return Generator\dropWhile($iterable, $predicate);
	}

	if (is_null($iterable)) {
		return [];
	}

	$keys = [];
	$done = false;

	foreach ($iterable as $key => $value) {
		if (!$done && call_user_func($predicate, $value, $key, $iterable)) {
			continue;
		}
		else {
			$done = true;
			$keys[] = $key;
		}
	}

	return pick($iterable, $keys);
}
