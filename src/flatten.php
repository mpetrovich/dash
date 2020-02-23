<?php

namespace Dash;

/**
 * Gets a list of nested elements in `$iterable`.
 *
 * Keys in `$iterable` are not preserved.
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
	// === [1, 2, 3]
 *
 * @example With a mix of nested and non-nested iterables
	Dash\flatten([1, 2, [3, 4]]);
	// === [1, 2, 3, 4]
 *
 * @example Deeply nested array
	Dash\flatten([
		[1, 2],
		[[3, 4]]
	]);
	// === [1, 2, [3, 4]]
 */
function flatten($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return reduce($iterable, function ($flattened, $value) {
		return array_merge($flattened, is_array($value) ? array_values($value) : [$value]);
	}, []);
}
