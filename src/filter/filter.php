<?php

namespace Dash;

/**
 * Returns a subset of $iterable for which $predicate is truthy. Keys are preserved.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param callable $predicate Callable invoked with ($value, $key, $iterable) for each item in $iterable
 * @return array
 *
 * @example
	filter([1, 2, 3, 4], function ($n) { return $n > 2; });  // === [3, 4]
	filter([1, 2, 3, 4], 'Dash\isEven');  // === [2, 4]
 */
function filter($iterable, $predicate)
{
	if (empty($iterable)) {
		return [];
	}

	$filtered = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$filtered[$key] = $value;
		}
	}

	return $filtered;
}
