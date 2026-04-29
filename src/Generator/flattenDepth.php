<?php

namespace Dash\Generator;

/**
 * @see Dash\flattenDepth()
 */
// @codingStandardsIgnoreLine
function flattenDepth($iterable, $depth = 1)
{
	$d = (int) $depth;

	if ($d <= 0) {
		foreach ($iterable as $key => $value) {
			yield $key => $value;
		}

		return;
	}

	yield from flattenDepth(\Dash\flatten($iterable), $d - 1);
}
