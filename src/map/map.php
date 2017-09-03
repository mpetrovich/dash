<?php

namespace Dash;

/**
 * Creates a new indexed array of values by running each element in a
 * collection through an iteratee function.
 *
 * Keys in the original collection are _not_ preserved; a freshly indexed array
 * is returned.
 *
 * @category Iterable
 * @param array|object $iterable
 * @param Callable|string $iteratee Function called with (element, key, collection)
 *                                  for each element in $iterable. The return value of $iteratee will
 *                                  be used as the corresponding element in the returned array.
 *                                  If $iteratee is a string, property($iteratee) will be used as the
 *                                  iteratee function.
 *
 * @return array
 *
 * @example
	Dash\map(
		[1, 2, 3],
		function($n) {
			return $n * 2;
		}
	) == [2, 4, 6];
 *
 * @example
	Dash\map(
		['roses' => 'red', 'violets' => 'blue'],
		function($color, $flower) {
			return $flower . ' are ' . $color;
		}
	) == ['roses are red', 'violets are blue'];
 *
 * @example With $iteratee as a path
	Dash\map(
		['color' => 'red', 'color' => 'blue'],
		'color'
	) == ['red', 'blue'];
 */
function map($iterable, $iteratee = 'Dash\identity')
{
	if (empty($iterable)) {
		return [];
	}

	$iteratee = property($iteratee);
	$mapped = [];

	foreach ($iterable as $key => $value) {
		$mapped[] = call_user_func($iteratee, $value, $key, $iterable);
	}

	return $mapped;
}
