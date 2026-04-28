<?php

namespace Dash\Generator;

/**
 * @see Dash\filter()
 */
// @codingStandardsIgnoreLine
function filter($iterable, $predicate = 'Dash\identity')
{
	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$index = 0;
	$isIndexedArray = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if (call_user_func($predicate, $value, $key, $iterable)) {
			if ($isIndexedArray) {
				yield $value;
			}
			else {
				yield $key => $value;
			}
		}

		$index++;
	}
}
