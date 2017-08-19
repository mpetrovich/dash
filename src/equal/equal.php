<?php

namespace Dash;

/**
 * Returns whether $a and $b are loosely equal.
 *
 * @category Utility
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	equal('1', 1);  // === true
 */
function equal($a, $b)
{
	return $a == $b;
}
