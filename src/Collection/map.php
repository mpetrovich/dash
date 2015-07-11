<?php

namespace Dash\Collection;

/**
 * Creates a new indexed array of values by running each element in a
 * collection through an iteratee function.
 *
 * Keys in the original collection are _not_ preserved; a freshly indexed array
 * is returned.
 *
 * @param array|object $collection
 * @param Callable|string $iteratee Function called with (element, key, collection)
 *        for each element in $collection. The return value of $iteratee will
 *        be used as the corresponding element in the returned array.
 *        If $iteratee is a string, property($iteratee) will be used as the
 *        iteratee function.
 *
 * @return array
 *
 * @example
	Dash\Collection\map(
		array(1, 2, 3),
		function($n) { return $n * 2; }
	) == array(2, 4, 6);
 *
 * @example
	Dash\Collection\map(
		array('roses' => 'red', 'violets' => 'blue'),
		function($color, $flower) { return $flower . ' are ' . $color; }
	) == array('roses are red', 'violets are blue');
 *
 * @example With $iteratee as a path
	Dash\Collection\map(
		array('color' => 'red', 'color' => 'blue'),
		'color'
	) == array('red', 'blue');
 */
function map($collection, $iteratee)
{
	$mapped = array();
	$index = 0;
	$iteratee = property($iteratee);

	foreach ($collection as $key => $value) {
		$mapped[$index] = call_user_func($iteratee, $value, $key, $collection);
		$index++;
	}

	return $mapped;
}
