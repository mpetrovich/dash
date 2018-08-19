<?php

namespace Dash;

/**
 * Gets the key and value of the last element for which `$predicate` returns truthy.
 *
 * Iteration begin at the end and will stop at the last truthy return value.
 *
 * @see findLastKey(), findLastValue(), find()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable` until a truthy value is returned;
 *                                         if a string, will get the last element with a truthy value at `$field`;
 *                                         if an array of form `[$field, $value]`, will get the last element
 *                                         whose `$field` loosely equals `$value`
 * @return array|null `[$key, $value]` of the last matching element, or null if not found
 *
 * @example
	Dash\findLast(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === ['d', 4]

	Dash\findLast(
		['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
		function ($value, $key) { return $value > 1 && $key !== 'b'; }
	);
	// === ['d', 4]
 *
 * @example The default predicate checks truthiness
	Dash\findLast([0, null, false, 'a', true]);
	// === [4, true]
 *
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
		['name' => 'Jane', 'active' => false],
	];

	Dash\findLast($data, 'active');
	// === [2, ['name' => 'Pete', 'active' => true]]

	Dash\findLast($data, ['active', false]);
	// === [3, ['name' => 'Jane', 'active' => false]]
 */
function findLast($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$result = null;
	foreach (reverse($iterable) as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$result = [$key, $value];
			break;
		}
	}

	list($key, $value) = $result;
	$array = toArray($iterable);

	// If $iterable maps to an indexed array,
	// $key needs to be remapped to the original unreversed array
	if (isset($key) && isIndexedArray($array)) {
		$key = count($array) - $key - 1;
		$result = [$key, $value];
	}

	return $result;
}

/**
 * @codingStandardsIgnoreStart
 */
function _findLast(/* predicate, iterable */)
{
	return currify('Dash\findLast', func_get_args());
}
