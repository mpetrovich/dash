<?php

namespace Dash;

/**
 * Gets an array representation of `$iterable`.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @return array Empty array if `$iterable` is not iterable
 *
 * @example
	Dash\toArray((object) ['a' => 1, 'b' => 2]);
	// === ['a' => 1, 'b' => 2]

	Dash\toArray(new FilesystemIterator(__DIR__));
	// === [ SplFileInfo, SplFileInfo, ... ]
 */
function toArray($iterable)
{
	if (isType($iterable, ['Traversable', 'stdClass'])) {
		$array = [];
		foreach ($iterable as $key => $val) {
			$array[$key] = is_object($val) ? clone $val : $val;
		}
	}
	else {
		$array = (array) $iterable;
	}

	return $array;
}

/**
 * @codingStandardsIgnoreStart
 */
function _toArray(/* iterable */)
{
	return currify('Dash\toArray', func_get_args());
}
