<?php

namespace Dash;

/**
 * Returns the number of elements (for iterables) or characters (for strings) in $input.
 *
 * @category Utility
 * @param iterable|string $input
 * @param string $encoding (optional) The character encoding of $input if it is a string;
 *                         see mb_list_encodings() for the list of supported encodings
 * @return integer
 *
 * @see count
 *
 * @example
	size([1, 2, 3]);  // === 3
	size('Hello!');  // === 6
 */
function size($input, $encoding = 'UTF-8')
{
	if (is_array($input) || $input instanceof Countable) {
		$size = \count($input);
	}
	elseif (isType($input, 'iterable')) {
		$size = 0;
		foreach ($input as $value) {
			$size++;
		}
	}
	elseif (is_string($input)) {
		$size = mb_strlen($input, $encoding);
	}
	else {
		$size = null;
	}

	return $size;
}

/**
 * @codingStandardsIgnoreStart
 */
function count()
{
	return call_user_func_array('Dash\size', func_get_args());
}
