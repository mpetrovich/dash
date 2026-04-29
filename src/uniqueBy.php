<?php

namespace Dash;

/**
 * Returns a new list of unique values, where uniqueness is determined by the return value of `$iteratee`
 * for each element.
 *
 * The first occurrence of each computed key is kept. Keys are preserved unless `$iterable` is an indexed array.
 * If `$iterable` is a `Generator`, a lazy `Generator` is returned.
 *
 * @category Collections & iterators
 *
 * @see unique(), keyBy(), groupBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array|int $iteratee (optional) Same resolution as `groupBy()`: path on each value,
 *                                               or callable `($value, $key, $iterable)`.
 * @return array|iterable
 *
 * @alias uniqBy, distinctBy
 *
 * @example
	Dash\uniqueBy([1, 2, 1, 3, 2], 'Dash\identity');
	// === [1, 2, 3]
 *
 * @example With a path iteratee
	$rows = [
		['id' => 1, 'name' => 'a'],
		['id' => 1, 'name' => 'b'],
		['id' => 2, 'name' => 'c'],
	];
	Dash\uniqueBy($rows, 'id');
	// === [['id' => 1, 'name' => 'a'], ['id' => 2, 'name' => 'c']]
 */
// phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh -- mirrors groupBy iteratee handling
function uniqueBy($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\uniqueBy($iterable, $iteratee);
	}

	if (is_null($iterable)) {
		return [];
	}

	$seen = [];
	$out = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$computed = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$computed = call_user_func($mapper, $value, $key, $iterable);
		}

		$seenKey = serialize($computed);

		if (isset($seen[$seenKey])) {
			continue;
		}

		$seen[$seenKey] = true;
		$out[$key] = $value;
	}

	return isIndexedArray($iterable) ? array_values($out) : $out;
}

function uniqBy()
{
	return call_user_func_array('Dash\uniqueBy', func_get_args());
}

function distinctBy()
{
	return call_user_func_array('Dash\uniqueBy', func_get_args());
}
