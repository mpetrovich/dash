<?php

namespace Dash;

/**
 * Checks whether `$a` and `$b` are loosely equal (same value, possibly different types).
 *
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	Dash\equal(3, '3');
	// === true

	Dash\equal(3, 3);
	// === true

	Dash\equal([1, 2, 3], [1, '2', 3]);
	// === true

	Dash\equal([1, 2, 3], [3, 2, 1]);
	// === false
 */
function equal($a, $b)
{
	return $a == $b;
}
