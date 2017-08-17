<?php

namespace Dash;

/**
 * Gets the value at a path for all elements in a collection.
 *
 * @category Iterable
 * @param array|object $iterable
 * @param string $path Path of the property to retrieve;
 *                     can be nested by delimiting each sub-property or array index with a period
 * @param mixed $default
 * @return array
 *
 * @example
	Dash\pluck(
		array(
			array('a' => ['b' => 1]),
			['a' => 'missing'],
			array('a' => ['b' => 3]),
			array('a' => ['b' => 4]),
		),
		'a.b',
		'default'
	) == [1, 'default', 3, 4];
 */
function pluck($iterable, $path, $default = null)
{
	return map($iterable, property($path, $default));
}
