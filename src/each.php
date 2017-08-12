<?php

namespace Dash;

/**
 * Iterates over a collection and calls an iteratee function for each element.
 *
 * Any changes to the value, key, or collection from within the iteratee
 * function are not persisted. If the original collection needs to be mutated,
 * use a native `foreach` loop instead.
 *
 * @param array|object $collection
 * @param Callable $iteratee Function called with (element, key, collection)
 *        for each element in $collection. If $iteratee returns false,
 *        subsequent elements will be skipped and iteration will end.
 *
 * @return array|object The original $collection
 *
 * @example
	Dash\each(
		array(1, 2, 3),
		function($n) { echo $n; }
	);  // Prints "123"
 */
function each($collection, $iteratee)
{
	$array = toArray($collection);
	array_walk($array, function($value, $key) use ($collection, $iteratee) {
		return $iteratee($value, $key, $collection);
	});

	return $collection;
}
