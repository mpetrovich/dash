<?php

namespace Dash;

/**
 * Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
 *
 * @see getDirect(), has(), property()
 *
 * @param mixed $input
 * @param callable|string|integer $path If a callable, invoked with `($input)` to get the value at `$path`;
 *                                      if a string or integer, will use `Dash\property($path)` to get the value at `$path`
 * @param mixed $default (optional) Value to return if `$path` does not exist within `$input`
 * @return mixed Value at `$path` or `$default` if no value exists
 *
 * @example
	$input = [
		'people' => [
			['name' => 'Pete'],
			['name' => 'John'],
			['name' => 'Mark'],
		]
	];
	Dash\get($input, 'people.2.name');
	// === 'Mark'
 *
 * @example Direct properties take precedence over nested ones
	$input = [
		'a.b.c' => 'direct',
		'a' => ['b' => ['c' => 'nested']]
	];
	Dash\get($input, 'a.b.c');
	// === 'direct'
 */
function get($input, $path, $default = null)
{
	if (is_null($input)) {
		return $default;
	}

	if (hasDirect($input, $path)) {
		return getDirect($input, $path);
	}

	$getter = is_callable($path) ? $path : property($path, $default);
	$value = $getter ? call_user_func($getter, $input, $default) : $default;
	return $value;
}
