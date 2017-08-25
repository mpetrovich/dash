<?php

namespace Dash;

/**
 * Returns the minimum value of an iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return mixed|null Null if $iterable is empty
 *
 * @example
	min([3, 8, 2, 5]);  // === 2
 */
function min($iterable)
{
	if (isEmpty($iterable)) {
		return null;
	}

	$min = reduce($iterable, function ($min, $value) {
		return \min($min, $value);
	}, +INF);

	return $min;
}
