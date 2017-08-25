<?php

namespace Dash;

/**
 * Sets the value at a path on $iterable, which will be modified.
 *
 * @category Iterable
 * @param array|object $iterable
 * @param string $path Path at which to set $value; can be a nested path (eg. 'a.b.0.c'),
 *                     and non-existent intermediate array/objects will be created
 * @param mixed $value Value to set at $path
 * @return array|object the modified $iterable
 * @throws UnexpectedValueException if $value cannot be set at $path (eg. trying to set a property on a number)
 *
 * @example
	$input = [
		'a' => [1, 2],
		'b' => [3, 4],
		'c' => [5, 6],
	];
	set($input, 'a', [7, 8, 9]);  // Setting a direct field
	set($input, 'b.0', 10);  // Setting a nested field using an array index
	// $input === [
		'a' => [7, 8, 9],
		'b' => [10, 4],
		'c' => [5, 6],
	]
 *
 * @example Matching intermediate array wrappers are created when the deepest path is an array
	$input = [];
	set($input, 'a.b.c', 'value');
	// $input === [
		'a' => [
			'b' => [
				'c' => 'value'
			]
		]
	]
 *
 * @example Matching intermediate object wrappers are created when the deepest path is an object
	$input = (object) [];
	set($input, 'a.b.c', 'value');
	// $input === (object) [
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
