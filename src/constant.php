<?php

namespace Dash;

/**
 * Returns a callable that always returns `$value`.
 *
 * @category Functions & composition
 *
 * @param mixed $value
 * @return callable
 */
function constant($value)
{
	return function () use ($value) {
		return $value;
	};
}
