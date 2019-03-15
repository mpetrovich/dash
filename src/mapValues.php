<?php

namespace Dash;

/**
 * Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.
 *
 * Unlike `map()`, keys in `$iterable` are preserved.
 *
 * @see map(), mapResult()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string $iteratee (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                  for each element in `$iterable`;
 *                                  if a string, will use `Dash\property($iteratee)` as the iteratee
 * @return array A new 0-indexed array
 *
 * @example
	Dash\mapValues(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
		return $value * 2;
	});
	// === ['a' => 2, 'b' => 4, 'c' => 6]
 *
 * @example With a path `$iteratee`
	$data = [
		'jdoe' => ['name' => ['first' => 'John', 'last' => 'Doe']],
		'mjane' => ['name' => ['first' => 'Mary', 'last' => 'Jane']],
		'psmith' => ['name' => ['first' => 'Pete', 'last' => 'Smith']],
	];
	Dash\mapValues($data, 'name.last');
	// === ['jdoe' => 'Doe', 'mjane' => 'Jane', 'psmith' => 'Smith']
 */
function mapValues($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$mapped = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$mapped[$key] = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$mapped[$key] = call_user_func($mapper, $value, $key, $iterable);
		}
	}

	return $mapped;
}
