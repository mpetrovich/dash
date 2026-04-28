<?php

namespace Dash\Generator;

/**
 * @see Dash\each()
 */
// @codingStandardsIgnoreLine
function each($iterable, $iteratee)
{
	foreach ($iterable as $key => $value) {
		$continue = call_user_func($iteratee, $value, $key, $iterable) !== false;
		yield $key => $value;

		if (!$continue) {
			break;
		}
	}
}
