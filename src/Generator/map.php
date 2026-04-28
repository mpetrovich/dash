<?php

namespace Dash\Generator;

/**
 * @see Dash\map()
 */
// @codingStandardsIgnoreLine
function map($iterable, $iteratee = 'Dash\identity')
{
	foreach ($iterable as $key => $value) {
		if (\Dash\hasDirect($value, $iteratee)) {
			yield \Dash\getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : \Dash\property($iteratee, null);
			yield call_user_func($mapper, $value, $key, $iterable);
		}
	}
}
