<?php

namespace Dash;

function assertType($value, $type)
{
	$types = (array) $type;

	$hasType = any($types, function($type) use ($value) {
		$func = "is_$type";
		return call_user_func($func, $value);
	});

	if (!$hasType) {
		throw new \InvalidArgumentException(sprintf(
			'Expected %s but was given %s',
			implode(' or ', $types),
			\gettype($value)
		));
	}
}
