<?php

namespace Dash;

/**
 * Checks whether two values are loosely equal (same value, but types can be different).
 *
 * @category Utility
 * @param mixed $a
 * @param mixed $b
 * @return boolean
 *
 * @example
	equal(3, '3');  // === true
	equal(3, 3);    // === true
 *
 * @example
	equal([1, 2, 3], [1, '2', 3]);  // === true
	equal([1, 2, 3], [1, 2, 3]);    // === true
 */
function equal($a, $b)
{
	return $a == $b;
}

/**
 * @codingStandardsIgnoreStart
 */
function _equal(/* a, b */)
{
	return call_user_func_array('Dash\curry', array_merge(['Dash\equal'], func_get_args()));
}
