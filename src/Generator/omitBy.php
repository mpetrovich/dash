<?php

namespace Dash\Generator;

/**
 * @see Dash\omitBy()
 */
// @codingStandardsIgnoreLine
function omitBy($iterable, $predicate = 'Dash\identity')
{
	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	yield from pickBy($iterable, \Dash\negate($predicate));
}
