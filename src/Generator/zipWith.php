<?php

namespace Dash\Generator;

/**
 * @see Dash\zipWith()
 */
// @codingStandardsIgnoreLine
function zipWith($iterable1, $iterable2, callable $combiner)
{
	foreach (\Dash\Generator\zip($iterable1, $iterable2) as $pair) {
		yield call_user_func($combiner, $pair[0], $pair[1]);
	}
}
