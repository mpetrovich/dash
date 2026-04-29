<?php

namespace Dash;

/**
 * Returns an array of length `$count` with every element set to `$value`.
 *
 * @param mixed $value
 * @param numeric $count
 * @return array
 */
function repeat($value, $count)
{
	assertType($count, 'numeric', __FUNCTION__);

	$count = intval($count);

	if ($count <= 0) {
		return [];
	}

	return array_fill(0, $count, $value);
}
