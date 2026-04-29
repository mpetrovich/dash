<?php

namespace Dash;

/**
 * Checks whether `$value` is a resource.
 *
 * @param mixed $value
 * @return boolean
 */
function isResource($value)
{
	return is_resource($value);
}
