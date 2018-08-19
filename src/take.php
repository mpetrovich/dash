<?php

namespace Dash;

/**
 * Gets a new array of the first `$count` elements of `$iterable`.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @see takeRight()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param integer $count If negative, gets all but the last `$count` elements of `$iterable`
 * @return array|iterable New array of `$count` elements
 *
 * @example
	Dash\take([2, 3, 5, 8, 13], 3);
	// === [2, 3, 5]

	Dash\take(['b' => 2, 'c' => 3, 'a' => 1], 2);
	// === ['b' => 2, 'c' => 3]

	Dash\take([1, 2, 3, 4, 5, 6], -2);
	// === [1, 2, 3, 4]
 */
function take($iterable, $count = 1)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		if ($count < 0) {
			throw new \InvalidArgumentException('Count cannot be negative when using a generator');
		}
		return Generator\take($iterable, $count);
	}

	$array = toArray($iterable);
	$preserveKeys = !isIndexedArray($array);
	$taken = array_slice($array, 0, $count, $preserveKeys);

	return $taken;
}
