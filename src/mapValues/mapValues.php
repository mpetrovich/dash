<?php

namespace Dash;

/**
 * Creates a new array of values by running each element in a collection
 * through an iteratee function.
 *
 * Keys in the original collection _are_ preserved.
 *
 * @category Collection
 * @param array|object $iterable
 * @param Callable $iteratee Function called with (element, key, collection)
 *                           for each element in $iterable. The return value of $iteratee will
 *                           be used as the corresponding element in the returned array.
 *
 * @return array
 *
 * @example
	Dash\map(
		[1, 2, 3],
		function($n) { return $n * 2; }
	) == [2, 4, 6];
 *
 * @example
	Dash\map(
		['roses' => 'red', 'violets' => 'blue'],
		function($color, $flower) { return $flower . ' are ' . $color; }
	) == ['roses' => 'roses are red', 'violets' => 'violets are blue'];
 */
function mapValues($iterable, $iteratee = 'Dash\identity')
{
	$mapped = [];
	$iteratee = property($iteratee);

	foreach ($iterable as $key => $value) {
		$mapped[$key] = call_user_func($iteratee, $value, $key, $iterable);
	}

	return $mapped;
}
