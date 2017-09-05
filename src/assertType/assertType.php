<?php

namespace Dash;

/**
 * Throws an `InvalidArgumentException` exception if `$value` is not of type `$type`.
 * If `$value` is an accepted type, this function is a no-op.
 *
 * See Dash\isType() for the available types.
 *
 * @category Utility
 * @param mixed $value
 * @param string|array $type Single type to check or a list of accepted types
 * @param string $funcName (optional) Name of the calling function where `assertType()` was called;
 *                         this is used in the thrown exception message and aids debugging
 * @return void
 * @throws InvalidArgumentException
 *
 * @example
	$value = [1, 2, 3];
	Dash\assertType($value, ['iterable', 'stdClass']);
	// Does not throw an exception

	$value = [1, 2, 3];
	Dash\assertType($value, 'object');
	// Throws an exception
 */
function assertType($value, $type, $funcName = __FUNCTION__)
{
	if (!isType($value, $type)) {
		throw new \InvalidArgumentException(sprintf(
			'%s expects %s but was given %s',
			$funcName,
			\implode(' or ', (array) $type),
			is_object($value) ? get_class($value) : gettype($value)
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
