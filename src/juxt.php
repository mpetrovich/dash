<?php

namespace Dash;

/**
 * Creates a function that applies each function in `$functions` to the same runtime arguments and
 * returns an array of results in order.
 *
 * @param iterable|stdClass|null $functions
 * @return callable
 *
 * @alias over
 *
 * @example
	$fn = Dash\juxt([
		function ($n) { return $n + 1; },
		function ($n) { return $n * 2; },
	]);
	$fn(3);  // === [4, 6]
 */
function juxt($functions)
{
	assertType($functions, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	$functions = toArray($functions);

	return function () use ($functions) {
		$args = func_get_args();
		$out = [];

		foreach ($functions as $fn) {
			$out[] = call_user_func_array($fn, $args);
		}

		return $out;
	};
}

function over()
{
	return call_user_func_array('Dash\juxt', func_get_args());
}
