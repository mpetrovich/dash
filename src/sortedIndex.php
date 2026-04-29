<?php

namespace Dash;

/**
 * Returns the insertion index for `$value` in an already-sorted `$iterable`.
 *
 * Uses `$comparator($left, $right)` with `Dash\compare` semantics.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param mixed $value
 * @param callable $comparator (optional)
 * @return integer
 */
function sortedIndex($iterable, $value, $comparator = 'Dash\compare')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = values($iterable);
	$count = count($values);

	for ($i = 0; $i < $count; $i++) {
		if (call_user_func($comparator, $values[$i], $value) >= 0) {
			return $i;
		}
	}

	return $count;
}
