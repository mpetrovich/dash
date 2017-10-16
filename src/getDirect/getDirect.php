<?php

namespace Dash;

/**
 * Gets the array value, object property, or method at `$key` within `$iterable`.
 *
 * If an array offset, object property, and/or method all exist for the same key,
 * the value at the array offset takes precedence and will be returned.
 *
 * @see getDirectRef(), hasDirect(), get()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param string $key Array offset, object property name, or method name
 * @param mixed $default (optional) Value to return if `$iterable` has nothing at `$key`
 * @return mixed
 *
 * @example
	Dash\getDirect(['a' => 'one', 'b' => 'two'], 'b');
	// === 'two'

	Dash\getDirect((object) ['a' => 'one', 'b' => 'two'], 'b');
	// === 'two'

	$count = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
	$count();
	// === 3
 *
 * @example Array offsets take precedence over object properties
	$iterable = new ArrayObject(['a' => 'array value']);
	$iterable->a = 'object value';

	Dash\getDirect($iterable, 'a');
	// === 'array value'
 */
function getDirect($iterable, $key, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

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

/**
 * @codingStandardsIgnoreStart
 */
function _getDirect(/* key, default, iterable */)
{
	return currify('Dash\getDirect', func_get_args());
}
