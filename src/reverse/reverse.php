<?php

namespace Dash;

/**
 * Gets a new array of `$iterable` elements in reverse order.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param boolean $preserveIntegerKeys (optional) If true, integer keys will be preserved;
 *                                     non-integer keys are always preserved regardless of this setting
 * @return array New array of `$iterable` elements in reverse order
 *
 * @example
	Dash\reverse(['a', 'b', 'c']);
	// === ['c', 'b', 'a']

	Dash\reverse(['a' => 1, 'b' => 2, 'c' => 3]);
	// === ['c' => 3, 'b' => 2, 'a' => 1]
 *
 * @example Preserving integer keys
	Dash\reverse(['a', 'b', 'c'], true);
	// === [2 => 'c', 1 => 'b', 0 => 'a']

	Dash\reverse(['a', 'b', 'c'], false);
	// === [0 => 'c', 1 => 'b', 2 => 'a']
 */
function reverse($iterable, $preserveIntegerKeys = false)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	return array_reverse(toArray($iterable), $preserveIntegerKeys);
}

/**
 * @codingStandardsIgnoreStart
 */
function _reverse(/* preserveIntegerKeys, iterable */)
{
	return currify('Dash\reverse', func_get_args());
}
