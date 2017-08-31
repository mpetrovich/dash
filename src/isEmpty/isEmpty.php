<?php

namespace Dash;

/**
 * Checks whether a value is an empty iterable or value.
 *
 * A value is empty if it is an iterable of size zero or loosely equals false.
 * @link http://php.net/manual/en/function.empty.php
 *
 * @category Iterable
 * @param mixed $input
 * @return boolean
 *
 * @example
	isEmpty([]);                 // === true
	isEmpty(new ArrayObject());  // === true
	isEmpty('');                 // === true
	isEmpty(0);                  // === true
	isEmpty([0]);                // === false
 */
function isEmpty($input)
{
	if ($input instanceof \DirectoryIterator) {
		// empty() segfaults with DirectoryIterator
		return count(toArray($input)) === 0;
	}

	return empty($input) || size($input) === 0;
}
