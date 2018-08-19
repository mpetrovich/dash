<?php

namespace Dash;

/**
 * Checks whether `$predicate` returns truthy for every item in `$iterable`.
 *
 * Iteration will stop at the first falsey return value.
 *
 * Note: Returns true if `$iterable` is empty, because everything is true of empty iterables.
 * @link https://en.wikipedia.org/wiki/Vacuous_truth
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable $predicate (optional) Invoked with `($value, $key, $iterable)` for each element in `$iterable`
 * @return boolean true if `$predicate` returns truthy for every item in `$iterable`
 *
 * @alias every
 *
 * @example
	Dash\all([1, 3, 5], 'Dash\isOdd');
	// === true

	Dash\all([1, 3, 5], function ($n) { return $n != 3; });
	// === false

	Dash\all([], 'Dash\isOdd');
	// === true

	Dash\all((object) ['a' => 1, 'b' => 3, 'c' => 5], 'Dash\isOdd');
	// === true
 *
 * @example With the default predicate
	Dash\all([true, true, true]);
	// === true

	Dash\all([true, false, true]);
	// === false
 */
function all($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return !any($iterable, negate($predicate));
}

function every()
{
	return call_user_func_array('Dash\all', func_get_args());
}
