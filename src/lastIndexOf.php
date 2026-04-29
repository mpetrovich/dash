<?php

namespace Dash;

/**
 * Returns the positional index of the last element equal to `$value`, or `-1` if not found.
 *
 * Comparison is delegated to `$comparator($value, $current)`.
 *
 * @see indexOf(), contains()
 *
 * @param iterable|stdClass|null $iterable
 * @param mixed $value
 * @param numeric|null $fromIndex (optional) Last index to consider (negative offsets from the end)
 * @param callable $comparator (optional)
 * @return integer
 */
function lastIndexOf($iterable, $value, $fromIndex = null, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($fromIndex, ['numeric', 'null'], __FUNCTION__);

	$values = values($iterable);
	$count = count($values);

	if ($count === 0) {
		return -1;
	}

	if (is_null($fromIndex)) {
		$start = $count - 1;
	}
	else {
		$start = intval($fromIndex);

		if ($start < 0) {
			$start = $count + $start;
		}
	}

	$start = \min($count - 1, \max(0, $start));

	for ($i = $start; $i >= 0; $i--) {
		if (call_user_func($comparator, $value, $values[$i])) {
			return $i;
		}
	}

	return -1;
}
