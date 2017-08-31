<?php

namespace Dash;

/**
 * Throws an exception if $input's type is not $type.
 *
 * @category Utility
 * @param mixed $input
 * @param string|array $type Single type or list of types
 * @param string $function (optional) Name of function where assertType() was called
 * @return void
 * @throws \InvalidArgumentException if $input's type is not $type
 *
 * @example
	$input = [1, 2, 3];
	assertType($input, 'object');  // will throw
 */
function assertType($input, $type, $function = __FUNCTION__)
{
	if (!isType($input, $type)) {
		throw new \InvalidArgumentException(sprintf(
			'%s expects %s but was given %s',
			$function,
			\implode(' or ', (array) $type),
			is_object($input) ? get_class($input) : gettype($input)
		));
	}
}
