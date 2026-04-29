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
 */
function extend()
{
	return call_user_func_array('Dash\merge', func_get_args());
}
