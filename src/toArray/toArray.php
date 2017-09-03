<?php

namespace Dash;

/**
 * Returns an array representation of $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return array
 *
 * @example
	toArray((object) ['a' => 'one', 'b' => 'two']);
	// === ['a' => 'one', 'b' => 'two']
 */
function toArray($iterable)
{
	if ($iterable instanceof \DirectoryIterator) {
		// iterator_to_array() doesn't work as expected with DirectoryIterator
		// https://bugs.php.net/bug.php?id=49755
		$array = [];
		foreach ($iterable as $key => $val) {
			$array[$key] = is_object($val) ? clone $val : $val;
		}
	}
	elseif ($iterable instanceof \Traversable) {
		$array = iterator_to_array($iterable);
	}
	else {
		$array = (array) $iterable;
	}

	return $array;
}
