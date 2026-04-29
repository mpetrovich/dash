<?php

namespace Dash\Generator;

/**
 * @see Dash\flattenDeep()
 */
// @codingStandardsIgnoreLine
function flattenDeep($iterable)
{
	foreach ($iterable as $value) {
		if (is_array($value)) {
			yield from flattenDeep($value);
		}
		else {
			yield $value;
		}
	}
}
