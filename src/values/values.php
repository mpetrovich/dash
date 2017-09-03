<?php

namespace Dash;

/**
 * Gets the values of an iterable as an array.
 *
 * @category Iterable: Query
 * @param iterable $iterable
 * @return array
 *
 * @example
	values(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]);
	// === [3, 8, 2, 5]
 */
function values($iterable)
{
	return map($iterable);
}
