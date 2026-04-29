<?php

namespace Dash\Generator;

/**
 * @see Dash\drop()
 */
// @codingStandardsIgnoreLine
function drop($iterable, $count = 1)
{
	foreach ($iterable as $key => $value) {
		if ($count > 0) {
			$count--;
			continue;
		}
		yield $key => $value;
	}
}
