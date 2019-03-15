<?php

namespace Dash;

/**
 * Checks whether `$predicate` returns truthy for any item in `$iterable`.
 *
 * Iteration will stop at the first truthy return value.
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $predicate (optional) Invoked with `($value, $key, $iterable)` for each element in `$iterable`
 * @return boolean true if `$predicate` returns truthy for any element in `$iterable`
 *
 * @alias some
 *
 * @example
	Dash\any([1, 2, 3], 'Dash\isEven');
	// === true

	Dash\any([1, 2, 3], function ($n) { return $n > 5; });
	// === false

	Dash\any([], 'Dash\isOdd');
	// === false

	Dash\any((object) ['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isEven');
	// === true
 *
 * @example With the default predicate
	Dash\any([false, true, true]);
	// === true

	Dash\any([false, false, false]);
	// === false
 */
function any($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return false;
	}

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			return true;
		}
	}

	return false;
}

function some()
{
	return call_user_func_array('Dash\any', func_get_args());
}
