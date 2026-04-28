<?php

namespace Dash\Generator;

/**
 * @see Dash\mapValues()
 */
// @codingStandardsIgnoreLine
function mapValues($iterable, $iteratee = 'Dash\identity')
{
	foreach ($iterable as $key => $value) {
		if (\Dash\hasDirect($value, $iteratee)) {
			yield $key => \Dash\getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : \Dash\property($iteratee, null);
			yield $key => call_user_func($mapper, $value, $key, $iterable);
		}
	}
}
