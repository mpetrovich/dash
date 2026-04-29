<?php

namespace Dash;

/**
 * Gets the array value, object property, or method at `$key` within `$input`.
 *
 * If an array offset, object property, and/or method all exist for the same key,
 * the value at the array offset takes precedence and will be returned.
 *
 * @category Objects & paths
 *
 * @see getDirectRef(), hasDirect(), get()
 *
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
// phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh -- branching is intrinsic to direct access precedence rules.
function getDirect($input, $key, $default = null)
{
	$arrayKey = is_null($key) ? '' : $key;

	if (!is_string($key) && !is_numeric($key) && !is_null($key)) {
		$value = $default;
	} elseif (is_null($input)) {
		$value = $default;
	} elseif ($input instanceof \ArrayAccess && $input->offsetExists($arrayKey)) {
		$value = $input[$arrayKey];
	} elseif (is_array($input) && array_key_exists($arrayKey, $input)) {
		$value = $input[$arrayKey];
	} elseif (!is_null($key) && is_object($input) && property_exists($input, $key)) {
		$value = $input->$key;
	} elseif (!is_null($key) && (is_string($input) || is_object($input)) && method_exists($input, $key)) {
		$value = function () use ($input, $key) {
			return call_user_func_array([$input, $key], func_get_args());
		};
	} else {
		$array = toArray($input);
		$value = array_key_exists($arrayKey, $array) ? $array[$arrayKey] : $default;
	}

	return $value;
}
