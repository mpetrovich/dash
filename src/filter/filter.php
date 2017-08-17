<?php

namespace Dash;

/**
 * Returns a subset of $iterable for which $predicate is truthy.
 * Keys and key order are preserved.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param callable $predicate Callable invoked with ($value, $key) for each item in $iterable
 * @return array
 */
function filter($iterable, $predicate)
{
	$iterable = toArray($iterable);
	$filtered = [];

	// @todo Check for existence of ARRAY_FILTER_USE_BOTH and use array_filter() if it exists
	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			$filtered[$key] = $value;
		}
	}

	return $filtered;
}
