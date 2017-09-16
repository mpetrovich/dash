<?php

namespace Dash;

/**
 * Returns a subset of $iterable with the specified keys.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param string|array $keys
 * @return array|object array if $iterable is array-like, object if $iterable is object-like
 *
 * @example
	pick(['a' => 'one', 'b' => 'two', 'c' => 'three'], ['b', 'c']);
	// === ['b' => 'two', 'c' => 'three']
 */
function pick($iterable, $keys)
{
	assertType($iterable, ['iterable', 'stdClass'], __FUNCTION__);

	$keys = (array) $keys;
	$picked = filter($iterable, function ($value, $key) use ($keys) {
		return \in_array($key, $keys);
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
