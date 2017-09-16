<?php

namespace Dash;

/**
 * Gets a list of elements in `$iterable` for which `$predicate` returns falsey.
 * The opposite of `filter()`.
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @see filter()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                         for each element in `$iterable`;
 *                                         if a string, will get elements with a falsey value for that field/index;
 *                                         if an array of form `[$field, $value]`, will get elements where the
 *                                         field/index does not loosely equal `$value`
 * @return array List of elements in `$iterable` that do not satisfy `$predicate`
 *
 * @example
	Dash\reject([1, 2, 3, 4], 'Dash\isOdd');
	// === [2, 4]

	Dash\reject(
		[3 => 'c', 1 => 'a', 2 => 'b'],
		function ($value, $key) { return $key <= 1; }
	);
	// === [3 => 'c', 2 => 'b']
 *
 * @example The default predicate checks truthiness
	Dash\reject([1, 2, null, 3, false, true]);
	// === [null, false]
 *
 * @example With a field/value
	$data = [
		['name' => 'John', 'active' => false],
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true],
	];

	Dash\reject($data, 'active');
	// === [
		['name' => 'John', 'active' => false],
	]

	Dash\reject($data, ['active', false]);
	// === [
		['name' => 'Mary', 'active' => true],
		['name' => 'Pete', 'active' => true]
	]
 */
function reject($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

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

	return filter($iterable, negate($predicate));
}

/**
 * @codingStandardsIgnoreStart
 */
function _reject(/* predicate, iterable */)
{
	return currify('Dash\reject', func_get_args());
}
