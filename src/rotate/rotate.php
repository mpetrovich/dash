<?php

namespace Dash;

/**
 * Gets a new array of `$iterable` elements where `$count` elements are moved
 * from the beginning of `$iterable` to the end.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param integer $count If negative, moves `$count` elements from the end to the beginning
 * @return array New array of rotated elements
 *
 * @example
	Dash\rotate(['a', 'b', 'c', 'd', 'e'], 2);
	// === ['c', 'd', 'e', 'a', 'b']

	Dash\rotate(['a', 'b', 'c', 'd', 'e'], -1);
	// === ['e', 'a', 'b', 'c', 'd']
 */
function rotate($iterable, $count = 1)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$size = size($iterable);

	if ($size === 0) {
		return [];
	}

	$count = $count % $size;
	$array = toArray($iterable);

	if ($count === 0) {
		return $array;
	}

	$preserveKeys = !isIndexedArray($array);
	$rotated = array_merge(
		array_slice($array, $count, null, $preserveKeys),
		array_slice($array, 0, $count, $preserveKeys)
	);

	return $rotated;
}

/**
 * @codingStandardsIgnoreStart
 */
function _rotate(/* count, iterable */)
{
	return currify('Dash\rotate', func_get_args());
}
