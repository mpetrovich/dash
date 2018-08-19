<?php

namespace Dash;

/**
 * Gets the elements of `$iterable` with keys that match any in `$keys`.
 *
 * @see omit()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param string|array $keys Single key or list of keys
 * @return array
 *
 * @example
	Dash\pick(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']);
	// === ['b' => 2, 'c' => 3]
 */
function pick($iterable, $keys)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$keys = (array) $keys;
	$picked = filter($iterable, function ($value, $key) use ($keys) {
		return in_array($key, $keys);
	});

	return $picked;
}

/**
 * @codingStandardsIgnoreStart
 */
function _pick(/* keys, iterable */)
{
	return currify('Dash\pick', func_get_args());
}
