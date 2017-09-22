<?php

namespace Dash;

/**
 * Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.
 *
 * Keys in `$iterable` are not preserved. To preserve keys, use `mapValues()` instead.
 *
 * @see mapValues()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string $iteratee (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                  for each element in `$iterable`;
 *                                  if a string, will use `Dash\property($iteratee)` as the iteratee
 * @return array A new 0-indexed array
 *
 * @example
	Dash\map(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
		return $value * 2;
	});
	// === [2, 4, 6]
 *
 * @example With a path `$iteratee`
	$data = [
		['name' => ['first' => 'John', 'last' => 'Doe'], 'active' => false],
		['name' => ['first' => 'Mary', 'last' => 'Jane'], 'active' => true],
		['name' => ['first' => 'Pete', 'last' => 'Smith'], 'active' => true],
	];
	Dash\map($data, 'name.last');
	// === ['Doe', 'Jane', 'Smith']
 */
function map($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$iteratee = property($iteratee);
	$mapped = [];

	foreach ($iterable as $key => $value) {
		$mapped[] = call_user_func($iteratee, $value, $key, $iterable);
	}

	return $mapped;
}

/**
 * @codingStandardsIgnoreStart
 */
function _map(/* iteratee, iterable */)
{
	return currify('Dash\map', func_get_args());
}
