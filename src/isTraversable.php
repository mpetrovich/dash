<?php

namespace Dash;

/**
 * Checks whether `$value` is traversable.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isTraversable(new \ArrayIterator([]));
	// === true
 */
function isTraversable($value)
{
	return is_array($value) || $value instanceof \Traversable;
}
