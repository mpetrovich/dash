<?php

namespace Dash;

/**
 * Gets the value of the first element for which `$predicate` returns truthy.
 *
 * Iteration will stop at the first truthy return value.
 *
 * @see find(), findKey(), findLastValue()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable` until a truthy value is returned;
 *                                         if a string, will get the first element with a truthy value at `$field`;
 *                                         if an array of form `[$field, $value]`, will get the first element
 *                                         whose `$field` loosely equals `$value`
 * @return mixed|null The value of the first matching element, or null if not found
 *
 * @example
	Dash\findValue(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === 2

	Dash\findValue(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
		function ($value, $key) { return $value > 1 && $key !== 'b'; }
	);
	// === 3
 *
 * @example The default predicate checks truthiness
	Dash\findValue([0, null, false, 'a', true]);
	// === 'a'
 *
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
		['name' => 'Jane', 'active' => false],
	];

	Dash\findValue($data, 'active');
	// === ['name' => 'Mary', 'active' => true]

	Dash\findValue($data, ['active', false]);
	// === ['name' => 'John', 'active' => false]
 */
function findValue($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	list($key, $value) = find($iterable, $predicate);
	return $value;
}
