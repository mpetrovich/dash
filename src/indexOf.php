<?php

namespace Dash;

/**
 * Returns the positional index of the first element equal to `$value`, or `-1` if not found.
 *
 * Comparison is delegated to `$comparator($value, $current)`.
 *
 * @category Collections & iterators
 *
 * @see contains(), lastIndexOf()
 *
 * @param iterable|stdClass|null $iterable
 * @param mixed $value
 * @param numeric $fromIndex (optional) Start index (negative offsets from the end)
 * @param callable $comparator (optional)
 * @return integer
 *
 * @example
	Dash\indexOf(['a', 'b', 'c', 'b'], 'b');
	// === 1

	Dash\indexOf(['a', 'b', 'c', 'b'], 'b', 2);
	// === 3
 */
function indexOf($iterable, $value, $fromIndex = 0, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($fromIndex, 'numeric', __FUNCTION__);

	$values = values($iterable);
	$count = count($values);

	$start = intval($fromIndex);

	if ($start < 0) {
		$start = $count + $start;
	}

	$start = \max(0, $start);

	for ($i = $start; $i < $count; $i++) {
		if (call_user_func($comparator, $value, $values[$i])) {
			return $i;
		}
	}

	return -1;
}
