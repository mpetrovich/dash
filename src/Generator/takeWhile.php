<?php

namespace Dash\Generator;

/**
 * @see Dash\takeWhile()
 */
// @codingStandardsIgnoreLine
function takeWhile($iterable, $predicate = 'Dash\identity')
{
	foreach ($iterable as $key => $value) {
		if (!call_user_func($predicate, $value, $key)) {
			break;
		}

		yield $key => $value;
	}
}
