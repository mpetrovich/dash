<?php

namespace Dash\Generator;

/**
 * @see Dash\repeat()
 */
// @codingStandardsIgnoreLine
function repeat($value, $count)
{
	$count = intval($count);

	for ($i = 0; $i < $count; $i++) {
		yield $value;
	}
}
