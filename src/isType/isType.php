<?php

namespace Dash;

/**
 * Checks whether a value is of a particular data type.
 *
 * @category Utility
 * @param mixed $value Value to check
 * @param string|array $type Single type to check or a list of possible types; types can be:
 *                           a native data type (eg. 'string', 'array'),
 *                           a type corresponding to a native is_<type>() function (eg. 'numeric'),
 *                           a class instance (eg. 'DateTime')
 * @return boolean
 *
 * @example With a native data type
	isType([1, 2, 3], 'array');  // === true
 *
 * @example With a type corresponding to a native is_<type>() method
	isType(3.14, 'numeric');  // === true
 *
 * @example 'iterable', in contrast with is_iterable(), returns true for stdClass objects
	$obj = (objec) [1, 2, 3];
	is_iterable($obj);     // === false
	isType($obj, 'iterable');  // === true
 *
 * @example With a class instance
	isType(new ArrayObject([1, 2, 3]), 'ArrayObject');  // === true
 */
function isType($value, $type)
{
	$customTypeChecks = [
		'iterable' => function ($value) {
			return is_array($value)
				|| $value instanceof \Traversable
				|| $value instanceof \stdClass;
		},
		'number' => 'is_numeric',
	];

	$types = (array) $type;

	$isAnyType = false;

	foreach ($types as $type) {
		$customTypeCheck = isset($customTypeChecks[$type]) ? $customTypeChecks[$type] : null;
		$isInstanceOf = function ($value) use ($type) { return $value instanceof $type; };

		$typeCheck = $customTypeCheck ?: (function_exists("is_$type") ? "is_$type" : $isInstanceOf);

		$isType = call_user_func($typeCheck, $value);

		if ($isType) {
			$isAnyType = true;
			break;
		}
	}

	return $isAnyType;
}
