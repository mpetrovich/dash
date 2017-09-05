<?php

namespace Dash;

/**
 * Checks whether a value is of a particular data type.
 *
 * A types can be:
 * 1. a native data type: `string`, `array`, `integer`, etc.
 * 2. a type corresponding to a native `is_*()` function: `numeric` (for `is_numeric()`),
 *    `callable` (for `is_callable()`), etc.
 * 3. a class name: `DateTime`, `Dash\_`, etc.
 * 4. a custom type (see below)
 *
 * Custom types:
 * - `iterable`: Like `is_iterable()` but also returns true for `stdClass` objects
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
 * @example With a custom `iterable` type
	Dash\isType((object) [1, 2, 3], 'iterable');
	// === true

	Dash\isType((object) [1, 2, 3], 'iterable');
	// === false
 */
function isType($value, $type)
{
	if (!$type) {
		return true;
	}

	$types = (array) $type;

	foreach ($types as $type) {
		if ($type === 'iterable') {
			// Custom type
			$isType = is_array($value)
				|| $value instanceof \Traversable
				|| $value instanceof \stdClass;
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
