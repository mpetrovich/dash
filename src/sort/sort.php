<?php

namespace Dash;

/**
 * Returns a new array containing the sorted values of $iterable. Keys are preserved.
 *
 * @category Iterable: Transform
 * @param iterable $iterable
 * @param callable $comparator
 * @return array
 *
 * @example
	sort([4, 1, 3, 2]);
	// === [1, 2, 3, 4]
 */
function sort($iterable, $comparator = 'Dash\compare')
{
	$array = toArray($iterable);

	if (isIndexedArray($array)) {
		usort($array, $comparator);
	}
	else {
		uasort($array, $comparator);
	}

	return $array;
}
