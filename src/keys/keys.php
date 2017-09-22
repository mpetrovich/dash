<?php

namespace Dash;

/**
 * Gets the keys of `$iterable` as an array.
 *
 * @see values()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\keys(['c' => 3, 'a' => 1, 'b' => 2]);
	// === ['c', 'a', 'b']
 */
function keys($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return map($iterable, function ($value, $key) {
		return $key;
	});
}

/**
 * @codingStandardsIgnoreStart
 */
function _keys(/* iterable */)
{
	return currify('Dash\keys', func_get_args());
}
