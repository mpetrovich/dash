<?php

namespace Dash\Generator;

/**
 * @see Dash\mapKeys()
 */
// @codingStandardsIgnoreLine
function mapKeys($iterable, $iteratee = 'Dash\identity')
{
	foreach ($iterable as $key => $value) {
		if (\Dash\hasDirect($value, $iteratee)) {
			$newKey = \Dash\getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : \Dash\property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}

		yield $newKey => $value;
	}
}
