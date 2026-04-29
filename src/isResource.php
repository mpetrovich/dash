<?php

namespace Dash;

/**
 * Checks whether `$value` is a resource.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	$h = fopen('php://memory', 'r');
	Dash\isResource($h);
	// === true
	fclose($h);
 */
function isResource($value)
{
	return is_resource($value);
}
