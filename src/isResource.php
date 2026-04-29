<?php

namespace Dash;

/**
 * Checks whether `$value` is a resource.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isResource($value)
{
	return is_resource($value);
}
