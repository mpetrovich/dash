<?php

namespace Dash\Collection;

/**
 * Gets the value at a path on a collection.
 *
 * @param array|object $collection
 * @param string $path Path of the property to retrieve; can be nested by
 *        delimiting each sub-property or array index with a period
 * @param mixed $default Default value to return if nothing exists at $path
 *
 * @return mixed Value at $path on the collection
 *
 * @example
	$collection = array(
		'a' => array(
			'b' => 'value'
		)
	);
	Dash\Collection\get($collection, 'a.b') == 'value';
 *
 * @example Array elements can be referenced by index
	$collection = array(
		'people' => array(
			array('name' => 'Pete'),
			array('name' => 'John'),
			array('name' => 'Paul'),
		)
	);
	Dash\Collection\get($collection, 'people.1.name') == 'John';
 *
 * @example Keys with the same name as the full path can be used
	$collection = array('a.b.c' => 'value');
	Dash\Collection\get($collection, 'a.b.c') == 'value';
 */
function get($collection, $path, $default = null)
{
	$getter = property($path, $default);
	return call_user_func($getter, $collection);
}
