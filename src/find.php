<?php

namespace Dash;

/**
 * Gets the key and value of the first element for which `$predicate` returns truthy.
 *
 * Iteration will stop at the first truthy return value.
 *
 * @see findKey(), findValue(), findLast()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable` until a truthy value is returned;
 *                                         if a string, will get the first element with a truthy value at `$field`;
 *                                         if an array of form `[$field, $value]`, will get the first element
 *                                         whose `$field` loosely equals `$value`
 * @return array|null `[$key, $value]` of the matching key and value, or null if not found
 *
 * @example
	Dash\find(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === ['b', 2]

	Dash\find(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
		function ($value, $key) { return $value > 1 && $key !== 'b'; }
	);
	// === ['c', 3]
 *
 * @example The default predicate checks truthiness
	Dash\find([0, null, false, 'a', true]);
	// === [3, 'a']
 *
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
		['name' => 'Jane', 'active' => false],
	];

	Dash\find($data, 'active');
	// === [1, ['name' => 'Mary', 'active' => true]]

	Dash\find($data, ['active', false]);
	// === [0, ['name' => 'John', 'active' => false]]
 */
function find($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			return [$key, $value];
		}
	}

	return null;
}
