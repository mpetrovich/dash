<?php

namespace Dash;

/**
 * Gets the value at a path on a collection.
 *
 * @category Iterable
 * @param array|object $iterable
 * @param string $path Path of the property to retrieve;
 *                     can be nested by delimiting each sub-property or array index with a period
 * @param mixed $default Default value to return if nothing exists at $path
 *
 * @return mixed Value at $path on the collection
 *
 * @example
	$iterable = array(
		'a' => array(
			'b' => 'value'
		)
	);
	Dash\get($iterable, 'a.b') == 'value';
 *
 * @example Array elements can be referenced by index
	$iterable = array(
		'people' => array(
			array('name' => 'Pete'),
			array('name' => 'John'),
			array('name' => 'Paul'),
		)
	);
	Dash\get($iterable, 'people.1.name') == 'John';
 *
 * @example Keys with the same name as the full path can be used
	$iterable = array('a.b.c' => 'value');
	Dash\get($iterable, 'a.b.c') == 'value';
 */
function get($iterable, $path, $default = null)
{
	$getter = property($path, $default);
	return call_user_func($getter, $iterable);
}
