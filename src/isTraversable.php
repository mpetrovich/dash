<?php

namespace Dash;

/**
 * Checks whether `$value` is traversable.
 *
 * @param mixed $value
 * @return boolean
 */
function isTraversable($value)
{
	return is_array($value) || $value instanceof \Traversable;
}
