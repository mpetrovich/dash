<?php

namespace Dash\Generator;

/**
 * @see Dash\scan()
 */
// @codingStandardsIgnoreLine
function scan($iterable, $iteratee, $initial = [])
{
	$result = $initial;
	yield $result;

	foreach ($iterable as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
		yield $result;
	}
}
