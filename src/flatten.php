<?php

namespace Dash;

/**
 * Gets a list of nested elements in `$iterable`.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 * When flattening an associative array, keys will point at the first value from a nested iterable.
 *
 * @see groupBy()
 *
 * @param iterable|stdClass|null $iterable
 * @return array List of elements in `$iterable`, including elements of directly nested iterables.
 *
 * @example
	Dash\flatten([[1, 2], [3, 4]]);
	// === [1, 2, 3, 4]

	Dash\flatten([['a' => 1, 'b' => 2], ['c' => 3]]);
	// === ['a' => 1, 'b' => 2, 'c' => 3]
 *
 * @example With a mix of nested and non-nested iterables
	Dash\flatten([1, 2, [3, 4]]);
	// === [1, 2, 3, 4]
 *
 * @example Nested associative array, key preserved for first element.
	Dash\flatten([
		'a' => [1, 2],
		'b' => 3
	]);
	// === [
		'a' => 1,
		2
		'b' => 3
	]
 */
function flatten($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return reduce($iterable, function ($previous, $next, $key) {
		if ($key != null && $next != null) {
			$associativeArray = [];
			$associativeArray[$key] = ((array) $next)[0];

			$previous = \array_merge($previous, $associativeArray);
			$next = takeRight((array) $next, -1);
		}

		return \array_merge($previous, $next === null ? [null] : (array) $next);
	}, []);
}
