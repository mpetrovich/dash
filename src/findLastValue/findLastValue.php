<?php

namespace Dash;

/**
 * Gets the value of the last element for which `$predicate` returns truthy.
 *
 * Iteration begin at the end and will stop at the last truthy return value.
 *
 * @see findLast(), findLastKey(), findValue()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable` until a truthy value is returned;
 *                                         if a string, will get the last element with a truthy value at `$field`;
 *                                         if an array of form `[$field, $value]`, will get the last element
 *                                         whose `$field` loosely equals `$value`
 * @return mixed|null The value of the last matching element, or null if not found
 *
 * @example
	Dash\findLastValue(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === 4

	Dash\findLastValue(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
		function ($value, $key) { return $value > 1 && $key !== 'b'; }
	);
	// === 4
 *
 * @example The default predicate checks truthiness
	Dash\findLastValue([0, null, false, 'a', true]);
	// === true
 *
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
		['name' => 'Jane', 'active' => false],
	];

	Dash\findLastValue($data, 'active');
	// === ['name' => 'Pete', 'active' => true]

	Dash\findLastValue($data, ['active', false]);
	// === ['name' => 'Jane', 'active' => false]
 */
function findLastValue($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	list($key, $value) = findLast($iterable, $predicate);
	return $value;
}

/**
 * @codingStandardsIgnoreStart
 */
function _findLastValue(/* predicate, iterable */)
{
	return currify('Dash\findLastValue', func_get_args());
}
