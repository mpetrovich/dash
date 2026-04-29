<?php

namespace Dash;

/**
 * Creates a predicate that returns truthy if any predicate in `$predicates` returns truthy.
 *
 * Predicates are invoked with the same runtime arguments and evaluation short-circuits on the
 * first truthy result.
 *
 * @param iterable|stdClass|null $predicates
 * @return callable
 *
 * @alias overSome
 *
 * @example
	$fn = Dash\anyPass([
		function ($n) { return $n < 0; },
		function ($n) { return $n % 2 === 0; },
	]);
	$fn(4);  // === true
	$fn(3);  // === false
 */
function anyPass($predicates)
{
	assertType($predicates, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$predicates = toArray($predicates);

	return function () use ($predicates) {
		$args = func_get_args();

		foreach ($predicates as $predicate) {
			if (call_user_func_array($predicate, $args)) {
				return true;
			}
		}

		return false;
	};
}

function overSome()
{
	return call_user_func_array('Dash\anyPass', func_get_args());
}
