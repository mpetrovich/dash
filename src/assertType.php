<?php

namespace Dash;

function assertType($value, $type)
{
	$typeChecks = [
		'iterable' => function($value) {
			return is_array($value)
				|| $value instanceof \Traversable
				|| $value instanceof \stdClass;
		},
	];

	$types = (array) $type;

	$hasType = any($types, function($type) use ($value, $typeChecks) {
		$typeCheck = isset($typeChecks[$type]) ? $typeChecks[$type] : "is_$type";
		return call_user_func($typeCheck, $value);
	});

	if (!$hasType) {
		throw new \InvalidArgumentException(sprintf(
			'Expected %s but was given %s',
			implode(' or ', $types),
			\gettype($value)
		));
	}
}
