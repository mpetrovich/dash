<?php

namespace Dash;

/**
 * Gets the keys of an iterable as an array.
 *
 * @category Collection
 * @param iterable $iterable
 * @return array
 *
 * @example
	keys(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]);
	// === ['a', 'b', 'c', 'd']
 */
function keys($iterable)
{
	return map($iterable, function ($value, $key) {
		return $key;
	});
}
