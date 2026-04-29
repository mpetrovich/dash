<?php

namespace Dash;

/**
 * Sorts `$iterable` by the values produced by `$iteratee` for each element (stable tie-breaking).
 *
 * Keys are preserved unless `$iterable` is an indexed array.
 *
 * @see sort(), groupBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array|int $iteratee (optional) Same resolution as `groupBy()` for each element value.
 * @return array
 *
 * @example
	Dash\sortBy([['a' => 2], ['a' => 1], ['a' => 3]], 'a');
	// === [['a' => 1], ['a' => 2], ['a' => 3]]

	Dash\sortBy([4, 3, 5, 1, 2], 'Dash\identity');
	// === [1, 2, 3, 4, 5]
 */
// phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh -- stable decorate-sort per groupBy-style iteratee
function sortBy($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$array = toArray($iterable);
	$rows = [];
	$pos = 0;

	foreach ($array as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$sortKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$sortKey = call_user_func($mapper, $value, $key, $iterable);
		}

		$rows[] = [
			'key' => $key,
			'value' => $value,
			'sortKey' => $sortKey,
			'pos' => $pos++,
		];
	}

	usort($rows, function ($a, $b) {
		$c = compare($a['sortKey'], $b['sortKey']);

		if ($c !== 0) {
			return $c;
		}

		return $a['pos'] <=> $b['pos'];
	});

	if (isIndexedArray($array)) {
		return array_column($rows, 'value');
	}

	$out = [];

	foreach ($rows as $row) {
		$out[$row['key']] = $row['value'];
	}

	return $out;
}
