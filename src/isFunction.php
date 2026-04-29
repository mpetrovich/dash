<?php

namespace Dash;

/**
 * Checks whether `$value` is callable.
 *
 * @param mixed $value
 * @return boolean
 */
function isFunction($value)
{
	return is_callable($value);
}
