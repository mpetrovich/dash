<?php

namespace Dash;

/**
 * Returns a callable that always returns `$value`.
 *
 * @category Functions & composition
 *
 * @param mixed $value
 * @return callable
 *
 * @example
	$alwaysSeven = Dash\constant(7);
	$alwaysSeven();  // === 7
 */
function constant($value)
{
	return function () use ($value) {
		return $value;
	};
}
