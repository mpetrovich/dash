<?php

namespace Dash;

/**
 * Returns a subset of $iterable for which $predicate is truthy. Keys are preserved.
 *
 * @category Collection
 * @param iterable $iterable
 * @param callable $predicate Callable invoked with ($value, $key, $iterable) for each item in $iterable
 * @return array
 *
 * @example
	filter([1, 2, 3, 4], function ($n) { return $n > 2; });  // === [3, 4]
	filter([1, 2, 3, 4], 'Dash\isEven');  // === [2, 4]
 *
 * @example With matchesProperty() shorthand
	filter([
		['name' => 'abc', 'active' => false],
		['name' => 'def', 'active' => true],
		['name' => 'ghi', 'active' => true],
	], 'active');
	// === [
		['name' => 'def', 'active' => true],
		['name' => 'ghi', 'active' => true]
	]
 */
function filter($iterable, $predicate)
{
	if (empty($iterable)) {
		return [];
	}

	$predicate = is_callable($predicate) ? $predicate : matchesProperty($predicate, true);

	$filtered = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$filtered[$key] = $value;
		}
	}

	return $filtered;
}
