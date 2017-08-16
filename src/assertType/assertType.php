<?php

namespace Dash;

function assertType($value, $type)
{
	if (!is($value, $type)) {
		throw new \InvalidArgumentException(sprintf(
			'Expected %s but was given %s',
			implode(' or ', (array) $type),
			\gettype($value)
		));
	}
}
