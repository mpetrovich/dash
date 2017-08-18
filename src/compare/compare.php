<?php

namespace Dash;

/**
 * Returns -1, 0, +1 if $a is less than, equal to, or great than $b, respectively.
 *
 * @param mixed $a
 * @param mixed $b
 * @return int
 *
 * @example
	compare(2, 3);  // === -1
	compare(2, 1);  // === +1
	compare(2, 2);  // === 0
 */
function compare($a, $b)
{
	if ($a == $b) {
		return 0;
	}
	elseif ($a > $b) {
		return +1;
	}
	else {
		return -1;
	}
}
