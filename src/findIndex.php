<?php

namespace Dash;

/**
 * Returns the 0-based index of the first element for which `$predicate` returns truthy, or `-1` if none.
 *
 * Counts in forward iteration order (unrelated to numeric array keys for associative iterables).
 *
 * @category Collections & iterators
 *
 * @see find(), findKey(), findLastIndex()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) Same forms as `find()`.
 * @return integer
 *
 * @example
	Dash\findIndex([1, 2, 3, 4], 'Dash\isEven');
	// === 1

	Dash\findIndex(['a' => 1, 'b' => 2], function ($v) { return $v === 2; });
	// === 1
 */
function findIndex($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return -1;
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$index = 0;

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			return $index;
		}
		$index++;
	}

	return -1;
}
