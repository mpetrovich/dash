<?php

namespace Dash\Generator;

/**
 * @see Dash\times()
 */
// @codingStandardsIgnoreLine
function times($n, $iteratee = 'Dash\identity')
{
	$count = intval($n);

	for ($i = 0; $i < $count; $i++) {
		yield call_user_func($iteratee, $i);
	}
}
