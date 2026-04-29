<?php

namespace Dash;

/**
 * Generates a unique id string, optionally prefixed.
 *
 * @category Utilities & misc
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
