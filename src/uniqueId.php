<?php

namespace Dash;

/**
 * Generates a unique id string, optionally prefixed.
 *
 * @category Utilities & misc
 *
 * @param string $prefix (optional)
 * @return string
 *
 * @example
	Dash\uniqueId('item_');  // e.g. 'item_1', then 'item_2', ...
 */
function uniqueId($prefix = '')
{
	static $counter = 0;
	$counter++;
	return (string) $prefix . $counter;
}
