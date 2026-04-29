<?php

namespace Dash\Generator;

/**
 * @see Dash\pickBy()
 */
// @codingStandardsIgnoreLine
function pickBy($iterable, $predicate = 'Dash\identity')
{
	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			yield $key => $value;
		}
	}
}
