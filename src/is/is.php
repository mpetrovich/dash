<?php

namespace Dash;

function is($value, $type)
{
	$customTypeChecks = [
		'iterable' => function ($value) {
			return is_array($value)
				|| $value instanceof \Traversable
				|| $value instanceof \stdClass;
		},
	];

	$types = (array) $type;

	$isAnyType = any($types, function ($type) use ($value, $customTypeChecks) {
		$customTypeCheck = isset($customTypeChecks[$type]) ? $customTypeChecks[$type] : null;
		$isInstanceOf = function ($value) use ($type) { return $value instanceof $type; };

		$typeCheck = $customTypeCheck ?: (function_exists("is_$type") ? "is_$type" : $isInstanceOf);

		$isType = call_user_func($typeCheck, $value);
		return $isType;
	});

	return $isAnyType;
}
