<?php

namespace Dash\Collections;

/**
 * Creates a function that returns the value at a path on a collection.
 *
 * @param string|function $path Path of the property to retrieve; can be nested
 *        by delimiting each sub-property or array index with a period. If it
 *        is a function, the same function is returned.
 * @param mixed $default Default value to return if nothing exists at $path
 *
 * @return function Function that accepts a collection and returns the value
 *         at $path on the collection
 *
 * @example
	$getter = Dash\Collections\property('a.b');
	$collection = array(
		'a' => array(
			'b' => 'value'
		)
	);
	$getter($collection) == 'value';
 *
 * @example Array elements can be referenced by index
	$getter = Dash\Collections\property('people.1.name');
	$collection = array(
		'people' => array(
			array('name' => 'Pete'),
			array('name' => 'John'),
			array('name' => 'Paul'),
		)
	);
	$getter($collection) == 'John';
 *
 * @example Keys with the same name as the full path can be used
	$getter = Dash\Collections\property('a.b.c');
	$collection = array('a.b.c' => 'value');
	$getter($collection) == 'value';
 */
function property($path, $default = null)
{
	if (is_callable($path)) {
		// $path is already a getter function
		return $path;
	}

	$getter = function($value) use ($path, $default) {
		// Checks for a direct element or property with the same name as $path
		if (is_array($value) && array_key_exists($path, $value)) {
			return $value[$path];
		}
		elseif (is_object($value) && property_exists($value, $path)) {
			return $value->$path;
		}

		$result = $value;
		$steps = explode('.', $path);

		foreach ($steps as $step) {
			if (is_array($result) && array_key_exists($step, $result)) {
				$result = $result[$step];
			}
			elseif (is_object($result) && property_exists($result, $step)) {
				$result = $result->$step;
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
