<?php

namespace Dash;

/**
 * Creates a predicate that returns truthy only if every predicate in `$predicates` returns truthy.
 *
 * Predicates are invoked with the same runtime arguments and evaluation short-circuits on the
 * first falsey result.
 *
 * @category Functions & composition
 *
 * @param iterable|stdClass|null $predicates
 * @return callable
 *
 * @alias overEvery
 *
 * @example
	$fn = Dash\allPass([
		function ($n) { return $n > 0; },
		function ($n) { return $n % 2 === 0; },
	]);
	$fn(4);  // === true
	$fn(3);  // === false
 */
function allPass($predicates)
{
	assertType($predicates, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$predicates = toArray($predicates);

	return function () use ($predicates) {
		$args = func_get_args();

		foreach ($predicates as $predicate) {
			if (!call_user_func_array($predicate, $args)) {
				return false;
			}
		}

		return true;
	};
}

function overEvery()
{
	return call_user_func_array('Dash\allPass', func_get_args());
}
