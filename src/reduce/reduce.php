<?php

namespace Dash;

/**
 * Iteratively reduces $iterable to a single value by way of $iteratee.
 *
 * @category Collection
 * @param iterable $iterable
 * @param callable $iteratee Invoked with ($result, $value, $key) for each ($key, $value) in $iterable
 *                           and the current $result. $iteratee should return the updated $result
 * @param mixed $initial (optional) Initial value
 * @return mixed
 *
 * @example Computes the sum
	reduce([1, 2, 3, 4], function ($result, $value) {
		return $result + $value;
	}, 0);
	// === 10
 */
function reduce($iterable, $iteratee, $initial = [])
{
	$result = $initial;

	foreach ($iterable as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
