<?php

namespace Dash;

/**
 * Returns -1, 0, +1 if $a is less than, equal to, or great than $b.
 *
 * @param mixed $a
 * @param mixed $b
 * @return int
 *
 * @example
	compare(8, 9);  // === -1
	compare(8, 4);  // === +1
	compare(8, 8);  // === 0
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
