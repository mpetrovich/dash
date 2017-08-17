<?php

namespace Dash;

/**
 * Gets the average of all values in $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return double Average value
 */
function average($iterable)
{
	$size = size($iterable);

	if ($size === 0) {
		return 0;
	}
	else {
		return sum($iterable) / $size;
	}
}
