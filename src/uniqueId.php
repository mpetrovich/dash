<?php

namespace Dash;

/**
 * Generates a unique id string, optionally prefixed.
 *
 * @param string $prefix (optional)
 * @return string
 */
function uniqueId($prefix = '')
{
	static $counter = 0;
	$counter++;
	return (string) $prefix . $counter;
}
