<?php

namespace Dash\Generator;

/**
 * @see Dash\flatten()
 */
// @codingStandardsIgnoreLine
function flatten($iterable)
{
	foreach ($iterable as $value) {
		if (is_array($value)) {
			foreach (array_values($value) as $nestedValue) {
				yield $nestedValue;
			}
		}
		else {
			yield $value;
		}
	}
}
