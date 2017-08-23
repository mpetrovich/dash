<?php

namespace Dash;

/**
 * Checks whether two values are strictly equal (same value and type).
 *
 * @category Utility
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	identical(3, '3');  // === false
	identical(3, 3);    // === true
 *
 * @example
	identical([1, 2, 3], [1, '2', 3]);  // === false
	identical([1, 2, 3], [1, 2, 3]);    // === true
 */
function identical($a, $b)
{
	return $a === $b;
}
