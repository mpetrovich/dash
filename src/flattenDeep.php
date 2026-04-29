<?php

namespace Dash;

/**
 * Recursively flattens nested arrays in `$iterable` into a single list (like repeated `flatten()` until no nested
 * arrays remain).
 *
 * Non-array elements are left as-is. Keys are not preserved.
 *
 * @category Collections & iterators
 *
 * @see flatten(), flattenDepth()
 *
 * @param iterable|stdClass|null $iterable
 * @return array|iterable
 *
 * @example
	Dash\flattenDeep([[1, [2, [3, 4]]], 5]);
	// === [1, 2, 3, 4, 5]
 */
function flattenDeep($iterable)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\flattenDeep($iterable);
	}

	if (is_null($iterable)) {
		return [];
	}

	$flat = [];

	foreach (toArray($iterable) as $value) {
		if (is_array($value)) {
			$flat = array_merge($flat, flattenDeep($value));
		}
		else {
			$flat[] = $value;
		}
	}

	return $flat;
}
