<?php

namespace Dash;

/**
 * Gets the value at a path for all elements in a collection.
 *
 * @category Collection
 * @param array|object $iterable
 * @param string $path Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period
 *
 * @return array
 *
 * @example
	Dash\pluck(
		array(
			array('a' => array('b' => 1)),
			array('a' => 'missing'),
			array('a' => array('b' => 3)),
			array('a' => array('b' => 4)),
		),
		'a.b',
		'default'
	) == array(1, 'default', 3, 4);
 */
function pluck($iterable, $path, $default = null)
{
	return map($iterable, property($path, $default));
}
