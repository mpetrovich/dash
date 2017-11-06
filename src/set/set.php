<?php

namespace Dash;

/**
 * Sets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
 * Note: This *will* modify `$input`.
 *
 * This operation does not have a curried variant.
 *
 * @see get(), getDirect(), property()
 *
 * @category Utility
 * @param mixed $input
 * @param string $path Path at which to set `$value`; can be a nested path (eg. `a.b.0.c`).
 *                     Intermediate arrays or objects will be created where missing (see examples)
 * @param mixed $value Value to set at $path
 * @return mixed `$input`, modified
 * @throws UnexpectedValueException if `$value` cannot be set at `$path`, eg. trying to set a property on a number
 *
 * @example
	$input = (object) [
		'a' => [1, 2],
		'b' => [3, 4],
		'c' => [5, 6],
	];
	Dash\set($input, 'a', [7, 8, 9]);
	Dash\set($input, 'b.0', 10);

	// $input === (object) [
		'a' => [7, 8, 9],
		'b' => [10, 4],
		'c' => [5, 6],
	]
 *
 * @example Intermediate array/objects are created if missing
	$input = ['a' => []];
	Dash\set($input, 'a.b.c', 'value');

	// $input === [
		'a' => [
			'b' => [
				'c' => 'value'
			]
		]
	]

	$input = ['a' => (object) []];
	Dash\set($input, 'a.b.c', 'value');

	// $input === [
		'a' => (object) [
			'b' => (object) [
				'c' => 'value'
			]
		]
	]
 */
function set(&$input, $path, $value)
{
	$steps = explode('.', $path);

	for ($target = &$input; $steps;) {
		$step = array_shift($steps);

		if (!isset($target)) {
			$target = [];
		}

		$hasDirect = hasDirect($target, $step);

		if (!$hasDirect && is_array($target)) {
			$target[$step] = [];
		}
		elseif (!$hasDirect && is_object($target)) {
			$target->$step = (object) [];
		}

		$target = &getDirectRef($target, $step);
	}

	$target = $value;

	return $input;
}
