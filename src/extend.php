<?php

namespace Dash;

/**
 * Alias of `merge()`.
 *
 * @category Objects & paths
 *
 * @see merge()
 *
 * @return array
 *
 * @example
	Dash\extend(['a' => 1], ['b' => 2], ['b' => 99]);
	// === ['a' => 1, 'b' => 99]
 */
function extend()
{
	return call_user_func_array('Dash\merge', func_get_args());
}
