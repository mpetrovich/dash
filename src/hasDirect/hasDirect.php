<?php

namespace Dash;

/**
 * Checks whether an iterable has a value at a given key.
 *
 * @category Iterable
 * @param array|object|ArrayAccess $iterable
 * @param string $key
 * @return boolean
 *
 * @example
	hasDirect(['a' => ['b' => 1, 'c' => 2], 'a');  // === true
	hasDirect(['a' => ['b' => 1, 'c' => 2], 'b');  // === false
 *
 * @example
	hasDirect((object) ['a' => 1, 'b' => 2], 'b');  // === true
 */
function hasDirect($iterable, $key)
{
	return is_array($iterable) && array_key_exists($key, $iterable)
		|| is_object($iterable) && property_exists($iterable, $key)
		|| $iterable instanceof \ArrayAccess && $iterable->offsetExists($key);
}
