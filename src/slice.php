<?php

namespace Dash;

/**
 * Returns a segment of `$iterable` from `$offset` with optional `$length`.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 *
 * For generators, only non-negative `$offset` and non-negative (or null) `$length` are supported.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $offset
 * @param integer|null $length
 * @return array|iterable
 *
 * @example
	Dash\slice([1, 2, 3, 4, 5], 1, 2);
	// === [2, 3]
 */
function slice($iterable, $offset = 0, $length = null)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($offset, 'numeric', __FUNCTION__);
	assertType($length, ['numeric', 'null'], __FUNCTION__);

	$offset = intval($offset);
	$length = is_null($length) ? null : intval($length);

	if ($iterable instanceof \Generator) {
		if ($offset < 0 || (!is_null($length) && $length < 0)) {
			throw new \InvalidArgumentException('Negative offset/length are not supported for generators');
		}

		return \Dash\Generator\slice($iterable, $offset, $length);
	}

	$array = toArray($iterable);
	$preserveKeys = !isIndexedArray($array);

	if (is_null($length)) {
		return array_slice($array, $offset, null, $preserveKeys);
	}

	return array_slice($array, $offset, $length, $preserveKeys);
}
