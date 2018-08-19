<?php

namespace Dash;

/**
 * Checks whether `$a` and `$b` are strictly equal (same value and type).
 *
 * @category Utility
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	Dash\identical(3, '3');
	// === false

	Dash\identical(3, 3);
	// === true

	Dash\identical([1, 2, 3], [1, '2', 3]);
	// === false

	Dash\identical([1, 2, 3], [1, 2, 3]);
	// === true
 */
function identical($a, $b)
{
	return $a === $b;
}

/**
 * @codingStandardsIgnoreStart
 */
function _identical(/* b, a */)
{
	return currify('Dash\identical', func_get_args());
}
