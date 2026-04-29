<?php

namespace Dash;

/**
 * Returns a random integer between `$min` and `$max` (inclusive).
 *
 * If only one argument is provided, it is treated as `$max` and `$min` defaults to 0.
 *
 * @param integer $min (optional)
 * @param integer|null $max (optional)
 * @return integer
 */
function random($min = 0, $max = null)
{
	assertType($min, 'numeric', __FUNCTION__);
	assertType($max, ['numeric', 'null'], __FUNCTION__);

	$min = (int) $min;

	if (is_null($max)) {
		$max = $min;
		$min = 0;
	}
	else {
		$max = (int) $max;
	}

	if ($min > $max) {
		$swap = $min;
		$min = $max;
		$max = $swap;
	}

	return mt_rand($min, $max);
}
