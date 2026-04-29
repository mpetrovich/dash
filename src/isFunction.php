<?php

namespace Dash;

/**
 * Checks whether `$value` is callable.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isFunction($value)
{
	return is_callable($value);
}
