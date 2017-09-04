<?php

namespace Dash;

/**
 * Throws an `InvalidArgumentException` exception if `$input` is not of type `$type`.
 * If `$input` is an accepted type, this function is a no-op.
 *
 * See Dash\isType() for the available types.
 *
 * @category Utility
 * @param mixed $input
 * @param string|array $type Single type to check or a list of accepted types
 * @param string $funcName (optional) Name of the calling function where `assertType()` was called;
 *                         this is used in the thrown exception message and aids debugging
 * @return void
 * @throws InvalidArgumentException
 *
 * @example
	$input = [1, 2, 3];
	Dash\assertType($input, 'iterable');
	// Does not throw an exception

	$input = [1, 2, 3];
	Dash\assertType($input, 'object');
	// Throws an exception
 */
function assertType($input, $type, $funcName = __FUNCTION__)
{
	if (!isType($input, $type)) {
		throw new \InvalidArgumentException(sprintf(
			'%s expects %s but was given %s',
			$funcName,
			\implode(' or ', (array) $type),
			is_object($input) ? get_class($input) : gettype($input)
		));
	}
}

/**
 * @codingStandardsIgnoreStart
 */
function _assertType(/* type, funcName, input */)
{
	return currify('Dash\assertType', func_get_args());
}
