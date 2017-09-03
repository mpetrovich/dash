<?php

namespace Dash;

/**
 * Sets the value at a path on $iterable, which will be modified.
 *
 * @category Collection
 * @param array|object $iterable
 * @param string $path Path at which to set $value; can be a nested path (eg. 'a.b.0.c'),
 *                     and non-existent intermediate array/objects will be created
 * @param mixed $value Value to set at $path
 * @return array|object the modified $iterable
 * @throws UnexpectedValueException if $value cannot be set at $path (eg. trying to set a property on a number)
 *
 * @example
	$iterable = [
		'a' => [1, 2],
		'b' => [3, 4],
		'c' => [5, 6],
	];
	set($iterable, 'a', [7, 8, 9]);  // Setting a direct field
	set($iterable, 'b.0', 10);  // Setting a nested field using an array index
	// $iterable === [
		'a' => [7, 8, 9],
		'b' => [10, 4],
		'c' => [5, 6],
	]
 *
 * @example Matching intermediate array wrappers are created when the deepest path is an array
	$iterable = [];
	set($iterable, 'a.b.c', 'value');
	// $iterable === [
		'a' => [
			'b' => [
				'c' => 'value'
			]
		]
	]
 *
 * @example Matching intermediate object wrappers are created when the deepest path is an object
	$iterable = (object) [];
	set($iterable, 'a.b.c', 'value');
	// $iterable === (object) [
		'a' => (object) [
			'b' => (object) [
				'c' => 'value'
			]
		]
	]
 */
function set(&$iterable, $path, $value)
{
	$steps = explode('.', $path);

	for ($target = &$iterable; $steps;) {
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

	return $iterable;
}
