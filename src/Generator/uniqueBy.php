<?php

namespace Dash\Generator;

/**
 * @see Dash\uniqueBy()
 */
// @codingStandardsIgnoreLine
function uniqueBy($iterable, $iteratee = 'Dash\identity')
{
	$seen = [];
	$index = 0;
	$isIndexedArray = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if (\Dash\hasDirect($value, $iteratee)) {
			$computed = \Dash\getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : \Dash\property($iteratee, null);
			$computed = call_user_func($mapper, $value, $key, $iterable);
		}

		$seenKey = serialize($computed);

		if (isset($seen[$seenKey])) {
			$index++;
			continue;
		}

		$seen[$seenKey] = true;

		if ($isIndexedArray) {
			yield $value;
		}
		else {
			yield $key => $value;
		}

		$index++;
	}
}
