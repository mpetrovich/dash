<?php

namespace Dash;

/**
 * Splits `$iterable` into two lists: elements for which `$predicate` returns truthy, and the rest.
 *
 * Keys are preserved in each list unless `$iterable` is an indexed array.
 *
 * @see filter(), reject()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) Same forms as `filter()`: callable `($value, $key, $iterable)`,
 *                                         string path for `matchesProperty`, or `[$field, $value]`.
 * @return array A two-element array: `[ $passing, $failing ]`, each an array
 *
 * @example
	Dash\partition([1, 2, 3, 4], 'Dash\isEven');
	// === [[2, 4], [1, 3]]
 *
 * @example With associative array
	Dash\partition(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
	// === [['b' => 2, 'd' => 4], ['a' => 1, 'c' => 3]]
 */
function partition($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [[], []];
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$pass = [];
	$fail = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$pass[$key] = $value;
		}
		else {
			$fail[$key] = $value;
		}
	}

	if (isIndexedArray($iterable)) {
		return [array_values($pass), array_values($fail)];
	}

	return [$pass, $fail];
}
