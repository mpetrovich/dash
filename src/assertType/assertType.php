<?php

namespace Dash;

/**
 * Throws an exception if $input's type is not $type.
 *
 * @category All
 * @param mixed $input
 * @param string|array $type Single type or list of types
 * @return void
 * @throws \InvalidArgumentException if $input's type is not $type
 *
 * @example
	$input = [1, 2, 3];
	assertType($input, 'object');  // will throw
 */
function assertType($input, $type)
{
	if (!is($input, $type)) {
		throw new \InvalidArgumentException(sprintf(
			'Expected %s but was given %s',
			implode(' or ', (array) $type),
			\gettype($input)
		));
	}
}
