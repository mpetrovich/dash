<?php

namespace Dash;

/**
 * Checks whether `$value` is empty.
 *
 * A value is empty if it is an iterable of size zero or loosely equals false.
 * @link http://php.net/manual/en/function.empty.php
 *
 * @category Utility
 * @param mixed $value
 * @return boolean True if `$value` is empty, false otherwise
 *
 * @example
	Dash\isEmpty([]);
	// === true

	Dash\isEmpty((object) []);
	// === true

	Dash\isEmpty(new ArrayObject());
	// === true

	Dash\isEmpty('');
	// === true

	Dash\isEmpty(0);
	// === true

	Dash\isEmpty([0]);
	// === false
 */
function isEmpty($value)
{
	// Special case since empty() segfaults with DirectoryIterator
	if ($value instanceof \DirectoryIterator) {
		return count(toArray($value)) === 0;
	}

	return empty($value) || size($value) === 0;
}

/**
 * @codingStandardsIgnoreStart
 */
function _isEmpty(/* value */)
{
	return currify('Dash\isEmpty', func_get_args());
}
