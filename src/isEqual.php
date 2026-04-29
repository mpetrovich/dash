<?php

namespace Dash;

/**
 * Alias of `equal()`.
 *
 * @category Predicates & comparison
 *
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	Dash\isEqual(['a' => 1], ['a' => 1]);
	// === true
 */
function isEqual($a, $b)
{
	return equal($a, $b);
}
