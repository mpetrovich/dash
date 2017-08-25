<?php

namespace Dash;

/**
 * Returns the maximum value of an iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return mixed|null Null if $iterable is empty
 *
 * @example
	max([3, 8, 2, 5]);  // === 8
 */
function max($iterable)
{
	if (isEmpty($iterable)) {
		return null;
	}

	$max = reduce($iterable, function ($max, $value) {
		return \max($max, $value);
	}, -INF);

	return $max;
}
