<?php

namespace Dash;

/**
 * Iteratively reduces `$iterable` to a single value by way of `$iteratee`.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable $iteratee Called with `($result, $value, $key)` for each `($key, $value)` in `$iterable`
 *                           and the current accumulated `$result`. `$iteratee` should return the updated `$result`
 * @param mixed $initial (optional) Initial value
 * @return mixed
 *
 * @example Computes the sum of an array's values
	Dash\reduce([1, 2, 3, 4], function ($sum, $value) {
		return $sum + $value;
	}, 0);
	// === 10
 */
function reduce($iterable, $iteratee, $initial = [])
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return $initial;
	}

	$result = $initial;

	foreach ($iterable as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
