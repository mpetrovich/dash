<?php

namespace Dash;

/**
 * Gets the value at `$path` within `$iterable`. Nested properties are accessible with dot notation.
 *
 * @see getDirect(), has(), property()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string $path (optional) If a callable, invoked with `($iterable)` to get the value at `$path`;
 *                              if a string, will use `Dash\property($path)` to get the value at `$path`
 * @param mixed $default (optional) Value to return if `$path` does not exist within `$iterable`
 * @return mixed Value at `$path` or `$default` if no value exists
 *
 * @example
	$iterable = [
		'people' => [
			['name' => 'Pete'],
			['name' => 'John'],
			['name' => 'Mark'],
		]
	];
	Dash\get($iterable, 'people.2.name');
	// === 'Mark';
 *
 * @example Direct properties take precedence over nested ones
	$iterable = [
		'a.b.c' => 'direct',
		'a' => ['b' => ['c' => 'nested']]
	];
	Dash\get($iterable, 'a.b.c');
	// === 'direct'
 */
function get($iterable, $path, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return $default;
	}

	$getter = property($path, $default);
	return call_user_func($getter, $iterable);
}

/**
 * @codingStandardsIgnoreStart
 */
function _get(/* path, default, iterable */)
{
	return currify('Dash\get', func_get_args());
}
