<?php

namespace Dash;

/**
 * @incomplete
 * Gets the value or callable at the given key of an iterable.
 *
 * If array offset and object properties exist for the same key,
 * the value at the array offset takes precedence and will be returned.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param string $key
 * @param mixed $default Value to return if no value at $key exists
 * @return mixed
 *
 * @example With an array
	getDirect(['a' => 'one', 'b' => 'two'], 'b');  // === 'two'
 *
 * @example With an object
	getDirect((object) ['a' => 'one', 'b' => 'two'], 'b');  // === 'two'
 */
function getDirect($iterable, $key, $default = null)
{
	if (is_array($iterable) && array_key_exists($key, $iterable)
		|| $iterable instanceof \ArrayAccess && isset($iterable[$key])
	) {
		$value = $iterable[$key];
	}
	elseif (is_object($iterable) && property_exists($iterable, $key)) {
		$value = $iterable->$key;
	}
	elseif (method_exists($iterable, $key)) {
		$value = function () use ($iterable, $key) {
			return call_user_func_array([$iterable, $key], func_get_args());
		};
	}
	else {
		$array = toArray($iterable);
		$value = isset($array[$key]) ? $array[$key] : $default;
	}

	return $value;
}
