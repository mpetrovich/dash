<?php

namespace Dash;

/**
 * Returns a number less than, equal to, or greater than zero
 * if `$a` is less than, equal to, or greater than `$b`.
 *
 * Uses loose equality for comparison. For comparison tables across data types,
 * see: http://php.net/manual/en/types.comparisons.php
 *
 * @category Utility
 * @param mixed $a
 * @param mixed $b
 * @return integer
 *
 * @example
	Dash\compare(2, 3);
	// < 0

	Dash\compare(2, 1);
	// > 0

	Dash\compare(2, 2);
	// === 0
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

/**
 * @codingStandardsIgnoreStart
 */
function _compare(/* b, a */)
{
	return currify('Dash\compare', func_get_args());
}
