<?php

namespace Dash;

/**
 * Returns values present in either `$iterable` or `$other`, but not both.
 *
 * Result order is `$iterable`-only values first, then `$other`-only values.
 *
 * @see difference(), union()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $other
 * @return array
 *
 * @example
	Dash\symmetricDifference([1, 2, 3], [2, 4]);
	// === [1, 3, 4]
 */
function symmetricDifference($iterable, $other)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($other, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$left = difference($iterable, $other);
	$right = difference($other, $iterable);

	return union($left, $right);
}
