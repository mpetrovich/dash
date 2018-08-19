<?php

namespace Dash;

/**
 * Iterates over elements of `$iterable` and invokes `$iteratee` for each element.
 *
 * `$iteratee` is invoked with `($value, $key, $iterable)` for each element.
 * Iteratees can exit iteration early by returning `false`.
 * Any changes to `$value`, `$key`, or `$iterable` from within the iteratee will not persisted.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable $iteratee
 * @return mixed $iterable The original `$iterable`
 *
 * @example
	Dash\each(['a', 'b', 'c'], function ($value, $index, $array) {
		echo "[$index]: $value\n";
	});
	// Prints:
	// [0]: 'a'
	// [1]: 'b'
	// [2]: 'c'
 *
 * @example Early exit
	Dash\each(['a', 'b', 'c'], function ($value, $index, $array) {
		echo "[$index]: $value\n";
		if ($value === 'b') {
			return false;
		}
	});
	// Prints:
	// [0]: 'a'
	// [1]: 'b'
 */
function each($iterable, $iteratee)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return $iterable;
	}

	foreach ($iterable as $key => $value) {
		if (call_user_func($iteratee, $value, $key, $iterable) === false) {
			break;
		}
	}

	return $iterable;
}
