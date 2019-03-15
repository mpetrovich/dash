<?php

namespace Dash;

/**
 * Gets the key of the last element for which `$predicate` returns truthy.
 *
 * Iteration begin at the end and will stop at the last truthy return value.
 *
 * @see findLast(), findLastValue(), findKey()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable` until a truthy value is returned;
 *                                         if a string, will get the last element with a truthy value at `$field`;
 *                                         if an array of form `[$field, $value]`, will get the last element
 *                                         whose `$field` loosely equals `$value`
 * @return string|null The key of the last matching element, or null if not found
 *
 * @example
	Dash\findLastKey(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === 'd'

	Dash\findLastKey(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
		function ($value, $key) { return $value > 1 && $key !== 'b'; }
	);
	// === 'd'
 *
 * @example The default predicate checks truthiness
	Dash\findLastKey([0, null, false, 'a', true]);
	// === 4
 *
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
		['name' => 'Jane', 'active' => false],
	];

	Dash\findLastKey($data, 'active');
	// === 2

	Dash\findLastKey($data, ['active', false]);
	// === 3
 */
function findLastKey($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	list($key, $value) = findLast($iterable, $predicate);
	return $key;
}
