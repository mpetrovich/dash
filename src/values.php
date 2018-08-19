<?php

namespace Dash;

/**
 * Gets the values of `$iterable` as an array.
 *
 * @see keys()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\values(['c' => 3, 'a' => 1, 'b' => 2]);
	// === [3, 1, 2]
 */
function values($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return map($iterable);
}
