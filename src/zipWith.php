<?php

namespace Dash;

/**
 * Combines two iterables element-wise using `$combiner($valueFromFirst, $valueFromSecond)`.
 *
 * Stops when the shorter iterable ends (same length rule as `zip()`).
 *
 * @param iterable|stdClass|null $iterable1
 * @param iterable|stdClass|null $iterable2
 * @param callable $combiner Invoked with `($valueFromFirst, $valueFromSecond)` for each aligned pair
 * @return array|iterable
 *
 * @example
	Dash\zipWith([1, 2, 3], [10, 20, 30], function ($a, $b) {
		return $a + $b;
	});
	// === [11, 22, 33]
 */
function zipWith($iterable1, $iterable2, callable $combiner)
{
	assertType($iterable1, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($iterable2, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable1 instanceof \Generator || $iterable2 instanceof \Generator) {
		return \Dash\Generator\zipWith($iterable1, $iterable2, $combiner);
	}

	$pairs = zip($iterable1, $iterable2);

	return map($pairs, function ($pair) use ($combiner) {
		return call_user_func($combiner, $pair[0], $pair[1]);
	});
}
