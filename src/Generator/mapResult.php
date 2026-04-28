<?php

namespace Dash\Generator;

/**
 * @see Dash\mapResult()
 */
// @codingStandardsIgnoreLine
function mapResult($iterable, $path, $default = null)
{
	foreach ($iterable as $key => $value) {
		$getter = \Dash\property($path, $default);
		yield $key => \Dash\result($value, $getter, $default);
	}
}
