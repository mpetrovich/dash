<?php

namespace Dash;

/**
 * Returns a new array of `$iterable` excluding all values in `$exclude` (loose equality).
 *
 * @see reject(), contains()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $exclude Values to exclude
 * @return array Subset of $iterable
 *
 * @example
	Dash\without(['a', 'b', 'c', 'd'], ['b', 'c']);
	// === ['a', 'd']
 */
function without($iterable, $exclude)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($exclude, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$without = reject($iterable, function ($value) use ($exclude) {
		return contains($exclude, $value);
	});

	return $without;
}
