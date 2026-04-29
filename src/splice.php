<?php

namespace Dash;

/**
 * Returns the segment removed by applying PHP-style splice parameters to `$iterable`.
 *
 * This operation is non-mutating with respect to the original input.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $offset
 * @param integer|null $length (optional)
 * @param iterable|stdClass|null $replacement (optional)
 * @return array Removed segment (reindexed)
 *
 * @example
	Dash\splice([1, 2, 3, 4], 1, 2, [9, 9]);
	// === [2, 3]  (the removed segment; input is not mutated)
 */
function splice($iterable, $offset, $length = null, $replacement = [])
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($offset, 'numeric', __FUNCTION__);
	assertType($length, ['numeric', 'null'], __FUNCTION__);
	assertType($replacement, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$array = values($iterable);
	$offset = (int) $offset;
	$length = is_null($length) ? count($array) : (int) $length;
	$replacement = values($replacement);

	return array_splice($array, $offset, $length, $replacement);
}
