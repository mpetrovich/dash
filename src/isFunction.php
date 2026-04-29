<?php

namespace Dash;

/**
 * Checks whether `$value` is callable.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isFunction(function () {});
	// === true
 */
function isFunction($value)
{
	return is_callable($value);
}
