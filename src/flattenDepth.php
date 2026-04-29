<?php

namespace Dash;

/**
 * Flattens nested arrays up to `$depth` levels (`1` behaves like `flatten()`).
 * A depth of `0` returns a copy of `$iterable` with the same indexed vs associative rules as other array-returning
 * operations.
 *
 * @category Collections & iterators
 *
 * @see flatten(), flattenDeep()
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $depth
 * @return array|iterable
 *
 * @example
	Dash\flattenDepth([[1, [2, [3]]]], 2);
	// === [1, 2, [3]]

	Dash\flattenDepth([[1, [2, [3]]]], 3);
	// === [1, 2, 3]
 */
function flattenDepth($iterable, $depth = 1)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($depth, 'numeric', __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\flattenDepth($iterable, $depth);
	}

	if (is_null($iterable)) {
		return [];
	}

	$d = (int) $depth;

	if ($d <= 0) {
		$a = toArray($iterable);

		return isIndexedArray($iterable) ? array_values($a) : $a;
	}

	$current = $iterable;

	for ($i = 0; $i < $d; $i++) {
		$current = flatten($current);
	}

	return $current;
}
