<?php

namespace Dash;

/**
 * Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
 * Like `get()` but if the value is callable, it is invoked and its return value is returned.
 *
 * @see get(), property()
 *
 * @category Utility
 * @param mixed $input
 * @param callable|string $path If a callable, invoked with `($input)` to get the value at `$path`;
 *                              if a string, will use `Dash\property($path)` to get the value at `$path`
 * @param mixed $default (optional) Value to return if `$path` does not exist within `$input`
 * @return mixed Value at `$path` or `$default` if no value exists
 *
 * @example
	$input = [
		'people' => new ArrayObject([
			['name' => 'Pete', 'getHash' => function () { return '4d17a4'; }],
			['name' => 'John', 'getHash' => function () { return 'fd2a48'; }],
			['name' => 'Paul', 'getHash' => function () { return 'd8575d'; }],
		])
	];

	Dash\result($input, 'people.1.name');
	// === 'John'

	Dash\result($input, 'people.count');
	// === 3

	Dash\result($input, 'people.1.joined.getTimestamp');
	// === 'fd2a48'
 */
function result($input, $path, $default = null)
{
	$value = get($input, $path, $default);

	if (is_callable($value)) {
		$value = call_user_func($value);
	}

	return $value;
}

/**
 * @codingStandardsIgnoreStart
 */
function _result(/* path, default, input */)
{
	return currify('Dash\result', func_get_args());
}
