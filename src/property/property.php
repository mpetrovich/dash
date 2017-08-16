<?php

namespace Dash;

/**
 * Creates a function that returns the value at a path on a collection.
 *
 * @category Iterable
 * @param string|function $path Path of the property to retrieve;
 *                              can be nested by delimiting each sub-property or array index with a period.
 *                              If it is a function, the same function is returned.
 * @param mixed $default Default value to return if nothing exists at $path
 * @return function Function that accepts a collection and returns the value at $path on the collection
 *
 * @example
	$getter = Dash\property('a.b');
	$iterable = array(
		'a' => array(
			'b' => 'value'
		)
	);
	$getter($iterable) == 'value';
 *
 * @example Array elements can be referenced by index
	$getter = Dash\property('people.1.name');
	$iterable = array(
		'people' => array(
			array('name' => 'Pete'),
			array('name' => 'John'),
			array('name' => 'Paul'),
		)
	);
	$getter($iterable) == 'John';
 *
 * @example Keys with the same name as the full path can be used
	$getter = Dash\property('a.b.c');
	$iterable = array('a.b.c' => 'value');
	$getter($iterable) == 'value';
 */
function property($path, $default = null)
{
	if (is_callable($path)) {
		// $path is already a getter function
		return $path;
	}

	$getter = function ($value) use ($path, $default) {
		// Short-circuit for direct properties
		if (hasDirect($value, $path)) {
			return getDirect($value, $path);
		}

		$result = $value;
		$steps = explode('.', $path);

		foreach ($steps as $step) {
			if (hasDirect($result, $step)) {
				$result = getDirect($result, $step);
			}
			else {
				$result = $default;
				break;
			}
		}

		return $result;
	};

	return $getter;
}
