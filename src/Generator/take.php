<?php

namespace Dash\Generator;

/**
 * @see Dash\take()
 */
// @codingStandardsIgnoreLine
function take($iterable, $count = 1)
{
	foreach ($iterable as $key => $value) {
		if ($count < 1) {
			break;
		}
		yield $key => $value;
		$count--;
	}
}
