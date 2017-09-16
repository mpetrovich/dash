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
 * @return array|object object if `$iterable` is an object, array otherwise
 *
 * @example
	Dash\pick(['a' => 1, 'b' => 2, 'c' => 3], ['b', 'c']);
	// === ['b' => 2, 'c' => 3]

	Dash\pick((object) ['a' => 1, 'b' => 2, 'c' => 3], ['b', 'c']);
	// === (object) ['b' => 2, 'c' => 3]
 */
function pick($iterable, $keys)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$keys = (array) $keys;
	$picked = filter($iterable, function ($value, $key) use ($keys) {
		return in_array($key, $keys);
	});

	return is_object($iterable) ? (object) $picked : $picked;
}

/**
 * @codingStandardsIgnoreStart
 */
function _pick(/* keys, iterable */)
{
	return currify('Dash\pick', func_get_args());
}
