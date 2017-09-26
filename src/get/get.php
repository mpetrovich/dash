<?php

namespace Dash;

/**
 * @incomplete
 * Gets the value at `$path` within `$iterable`. Nested properties can be accessing using dot notation.
 *
 * @see getDirect(), has()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string $path (optional) If a callable, invoked with `($iterable)` to get the value at `$path`;
 *                              if a string, will use `Dash\property($path)` to get the value at `$path`
 * @param mixed $default (optional) Value to return if `$path` does not exist within `$iterable`
 * @return mixed Value at `$path`
 *
 * @example
	$iterable = [
		'people' => [
			['name' => 'Pete'],
			['name' => 'John'],
			['name' => 'Mark'],
		]
	];
	Dash\get($iterable, 'people.2.name') == 'Mark';
 *
 * @example Direct properties take precedence over nested values
	$iterable = [
		'a.b.c' => 'direct',
		'a' => ['b' => ['c' => 'nested']]
	];
	Dash\get($iterable, 'a.b.c');
	// === 'direct'
 */
function get($iterable, $path, $default = null)
{
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
