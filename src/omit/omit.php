<?php

namespace Dash;

/**
 * Gets the elements of `$iterable` with keys that match any in `$keys`.
 *
 * @see pick()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param string|array $keys Single key or list of keys
 * @return array
 *
 * @example
	Dash\omit(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']);
	// === ['a' => 1, 'd' => 4]
 */
function omit($iterable, $keys)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$keys = (array) $keys;
	$omitted = reject($iterable, function ($value, $key) use ($keys) {
		return in_array($key, $keys);
	});

	return $omitted;
}

/**
 * @codingStandardsIgnoreStart
 */
function _omit(/* keys, iterable */)
{
	return currify('Dash\omit', func_get_args());
}
