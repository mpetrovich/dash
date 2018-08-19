<?php

namespace Dash;

/**
 * Gets the array value, object property, or method at `$key` within `$input`.
 *
 * If an array offset, object property, and/or method all exist for the same key,
 * the value at the array offset takes precedence and will be returned.
 *
 * @see getDirectRef(), hasDirect(), get()
 *
 * @category Utility
 * @param mixed $input
 * @param string $key Array offset, object property name, or method name
 * @param mixed $default (optional) Value to return if `$input` has nothing at `$key`
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
	$input = new ArrayObject(['a' => 'array value']);
	$input->a = 'object value';

	Dash\getDirect($input, 'a');
	// === 'array value'
 */
function getDirect($input, $key, $default = null)
{
	if (!is_string($key) && !is_numeric($key) && !is_null($key)) {
		return $default;
	}

	if ($input instanceof \ArrayAccess && $input->offsetExists($key)) {
		$value = $input[$key];
	}
	elseif (is_array($input) && array_key_exists($key, $input)) {
		$value = $input[$key];
	}
	elseif (is_object($input) && property_exists($input, $key)) {
		$value = $input->$key;
	}
	elseif (method_exists($input, $key)) {
		$value = function () use ($input, $key) {
			return call_user_func_array([$input, $key], func_get_args());
		};
	}
	else {
		$array = toArray($input);
		$value = isset($array[$key]) ? $array[$key] : $default;
	}

	return $value;
}
