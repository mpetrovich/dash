<?php

namespace Dash;

/**
 * Gets a list of elements in `$iterable` for which `$predicate` returns truthy.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @see reject()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable`;
 *                                         if a string, will get elements with truthy values at `$field`;
 *                                         if an array of form `[$field, $value]`, will get elements
 *                                         whose `$field` loosely equals `$value`
 * @return array|iterable List of elements in `$iterable` that satisfy `$predicate`
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
 * @example With a field and value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
	];

	Dash\filter($data, 'active');
	// === [
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true]
	]

	Dash\filter($data, ['active', false]);
	// === [
		['name' => 'John', 'active' => false],
	]
 */
function filter($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return Generator\filter($iterable, $predicate);
	}

	if (is_null($iterable)) {
		return [];
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$filtered = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$filtered[$key] = $value;
		}
	}

	return isIndexedArray($iterable) ? array_values($filtered) : $filtered;
}
