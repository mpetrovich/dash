<?php

namespace Dash;

/**
 * Groups the element values of `$iterable` by the common return values of `$iteratee`.
 *
 * @see keyBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string $iteratee (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                  for each element in `$iterable`
 *                                  if a string, will use `Dash\property($iteratee)` as the iteratee
 * @param string $defaultGroup (optional) The key for the set of elements for which `$iteratee` returns `null`
 * @return array A new associative array of `[key => [value, ...]]`
 *
 * @example
	Dash\groupBy(['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isOdd');
	// === [true => [1, 3], false => [2]]

	Dash\groupBy([2.1, 2.5, 3.5, 3.9, 4.1], Dash\unary('floor'));
	// === [2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4.1]]

 * @example With a path `$iteratee`
	$data = [
		['first' => 'John', 'last' => 'Doe'],
		['first' => 'Alice', 'last' => 'Hart'],
		['first' => 'Anonymous'],
		['first' => 'Jane', 'last' => 'Doe'],
		['first' => 'Peter', 'last' => 'Gibbons'],
		['first' => 'Fred', 'last' => 'Hart'],
	];

	Dash\groupBy($data, 'last');
	// === [
		'Doe' => [
			['first' => 'John', 'last' => 'Doe'],
			['first' => 'Jane', 'last' => 'Doe'],
		],
		'Hart' => [
			['first' => 'Alice', 'last' => 'Hart'],
			['first' => 'Fred', 'last' => 'Hart'],
		],
		'Gibbons' => [
			['first' => 'Peter', 'last' => 'Gibbons'],
		],
		null => [
			['first' => 'Anonymous'],
		],
	]

	Dash\groupBy($data, 'last', 'Unknown');
	// === [
		'Doe' => [
			['first' => 'John', 'last' => 'Doe'],
			['first' => 'Jane', 'last' => 'Doe'],
		],
		'Hart' => [
			['first' => 'Alice', 'last' => 'Hart'],
			['first' => 'Fred', 'last' => 'Hart'],
		],
		'Gibbons' => [
			['first' => 'Peter', 'last' => 'Gibbons'],
		],
		'Unknown' => [
			['first' => 'Anonymous'],
		],
	]
 */
function groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$grouped = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$newKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}
		$newKey = is_null($newKey) ? $defaultGroup : $newKey;
		$grouped[$newKey][] = $value;
	}

	return $grouped;
}
