<?php

namespace Dash;

/**
 * Checks whether a value is of a particular data type.
 *
 * A types can be:
 * - a native data type: `string`, `array`, `integer`, etc.
 * - a type corresponding to a native `is_*()` function:
 *   `numeric` (for `is_numeric()`), `callable` (for `is_callable()`), etc.
 * - a class name: `stdClass`, `DateTime`, `Dash\_`, etc.
 *
 * @category Utility
 * @param mixed $value
 * @param string|array $type Single type to check or a list of accepted types
 * @return boolean
 *
 * @example With a native data type
	Dash\isType([1, 2, 3], 'array');
	// === true
 *
 * @example With a type corresponding to a native `is_*()` function
	Dash\isType(3.14, 'numeric');
	// === true
 *
 * @example With a class name
	Dash\isType(new ArrayObject([1, 2, 3]), 'ArrayObject');
	// === true
 *
 * @example With multiple types
	Dash\isType((object) [1, 2, 3], ['array', 'object']);
	// === true
 */
function isType($value, $type)
{
	if (!$type) {
		return true;
	}

	$types = (array) $type;

	foreach ($types as $type) {
		if ($type === 'iterable' && !function_exists("is_$type")) {
			// Polyfills is_iterable() since it's only in PHP 7.1+
			$isType = is_array($value) || $value instanceof \Traversable;
		}
		elseif (function_exists("is_$type")) {
			// is_*() function type
			$isType = call_user_func("is_$type", $value);
		}
		else {
			// Class type
			$isType = ($value instanceof $type);
		}

		if ($isType) {
			return true;
		}
	}

	return false;
}

/**
 * @codingStandardsIgnoreStart
 */
function _isType(/* type, value */)
{
	return currify('Dash\isType', func_get_args());
}
