<?php

namespace Dash;

/**
 * Splits `$iterable` into groups of `$size`.
 *
 * The last group may contain fewer than `$size` elements.
 * Keys are preserved in each group unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $size
 * @return array|iterable A list of groups from `$iterable`
 *
 * @alias splitEvery
 *
 * @example
	Dash\chunk([1, 2, 3, 4, 5], 2);
	// === [[1, 2], [3, 4], [5]]
 *
 * @example With associative array
	Dash\chunk(['a' => 1, 'b' => 2, 'c' => 3], 2);
	// === [['a' => 1, 'b' => 2], ['c' => 3]]
 */
function chunk($iterable, $size)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($size, 'numeric', __FUNCTION__);

	$size = intval($size);
	if ($size < 1) {
		return [];
	}

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\chunk($iterable, $size);
	}

	$array = toArray($iterable);
	$preserveKeys = !isIndexedArray($array);
	return array_chunk($array, $size, $preserveKeys);
}

function splitEvery()
{
	return call_user_func_array('Dash\chunk', func_get_args());
}
