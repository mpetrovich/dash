<?php

namespace Dash;

/**
 * Returns a subset of $iterable for which $predicate is falsey. Keys are preserved.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param callable $predicate Callable invoked with ($value, $key, $iterable) for each item in $iterable
 * @return array
 *
 * @example
	reject([1, 2, 3, 4], function ($n) { return $n > 2; });  // === [1, 2]
	reject([1, 2, 3, 4], 'Dash\isEven');  // === [1, 3]
 *
 * @example With matchesProperty() shorthand
	reject([
		['name' => 'abc', 'active' => false],
		['name' => 'def', 'active' => true],
		['name' => 'ghi', 'active' => true],
	], 'active');
	// === [
		['name' => 'abc', 'active' => true],
	]
 */
function reject($iterable, $predicate)
{
	if (empty($iterable)) {
		return [];
	}

	$predicate = is_callable($predicate) ? $predicate : matchesProperty($predicate, true);

	return filter($iterable, negate($predicate));
}
