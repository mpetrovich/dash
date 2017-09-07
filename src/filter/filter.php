<?php

namespace Dash;

/**
 * Gets a list of elements in `$iterable` for which `$predicate` returns truthy.
 * Keys are preserved unless `$iterable` is an indexed array.
 *
 * An indexed array is one with sequential integer keys starting at zero. See Dash\isIndexedArray
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable`;
 *                                         if a string, will get elements with a truthy value for that field/index;
 *                                         if an array of form `[$field, $value]`, will get elements where the
 *                                         field/index loosely equals `$value`
 * @return array List of elements in `$iterable` that satisfy `$predicate`
 *
 * @example
	Dash\filter([1, 2, 3, 4], 'Dash\isEven');
	// === [2, 4]

	Dash\filter(
		[3 => 'c', 1 => 'a', 2 => 'b'],
		function ($value, $key) { return $key > 1; }
	);
	// === [3 => 'c', 2 => 'b']
 *
 * @example The default predicate checks truthiness
	Dash\filter([1, 2, null, 3, false, true]);
	// === [1, 2, 3, true]
 *
 * @example With a field/value
	$data = [
		['name' => 'abc', 'active' => false],
		['name' => 'def', 'active' => true],
		['name' => 'ghi', 'active' => true],
	];

	Dash\filter($data, 'active');
	// === [
		['name' => 'def', 'active' => true],
		['name' => 'ghi', 'active' => true]
	]

	Dash\filter($data, ['active', false]);
	// === [
		['name' => 'abc', 'active' => false],
	]
 */
function filter($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass'], __FUNCTION__);

	if (empty($iterable)) {
		return [];
	}

	if (!is_callable($predicate)) {
		if (is_array($predicate)) {
			// Invoked as ($iterable, [$field, $matchValue])
			list($field, $matchValue) = $predicate;
		}
		else {
			// Invoked as ($iterable, $field)
			$field = $predicate;
			$matchValue = true;
		}
		$predicate = matchesProperty($field, $matchValue);
	}

	$filtered = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$filtered[$key] = $value;
		}
	}

	return isIndexedArray($iterable) ? array_values($filtered) : $filtered;
}

/**
 * @codingStandardsIgnoreStart
 */
function _filter(/* predicate, iterable */)
{
	return currify('Dash\filter', func_get_args());
}
