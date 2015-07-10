<?php

namespace Dash\Collection;

/**
 * Creates a new array of values by running each element in a collection
 * through an iteratee function.
 *
 * Keys in the original collection _are_ preserved.
 *
 * @param array|object $collection
 * @param Callable $iteratee Function called with (element, key, collection)
 *        for each element in $collection. The return value of $iteratee will
 *        be used as the corresponding element in the returned array.
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
	) == array('roses' => 'roses are red', 'violets' => 'violets are blue');
 */
function mapValues($collection, $iteratee)
{
	$mapped = array();

	foreach ($collection as $key => $value) {
		$mapped[$key] = call_user_func($iteratee, $value, $key, $collection);
	}

	return $mapped;
}
