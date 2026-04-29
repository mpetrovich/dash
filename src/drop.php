<?php

namespace Dash;

/**
 * Gets a new array of `$iterable` without the first `$count` elements.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 *
 * @category Collections & iterators
 *
 * @see take()
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $count If negative, drops values from the end (array-like inputs only)
 * @return array|iterable
 *
 * @example
	Dash\drop([1, 2, 3, 4, 5], 2);
	// === [3, 4, 5]
 */
function drop($iterable, $count = 1)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		if ($count < 0) {
			throw new \InvalidArgumentException('Count cannot be negative when using a generator');
		}
		return Generator\drop($iterable, $count);
	}

	$array = toArray($iterable);
	$preserveKeys = !isIndexedArray($array);

	return array_slice($array, $count, null, $preserveKeys);
}
