<?php

namespace Dash;

/**
 * Invokes `$interceptor` with `($value)` and returns its result.
 *
 * @category Utility
 * @param mixed $value
 * @param callable $interceptor Invoked with `($value)`
 * @return mixed Return value of `$interceptor($value)`
 *
 * @example
	$result = _::chain([1, 3, 4])
		->filter('Dash\isOdd')
		->thru(function ($value) {
			// $value === [1, 3]
			$value[] = $value[0];
			return $value;
		})
		->value();

	// $result === [1, 3, 1]
 */
function thru($value, callable $interceptor)
{
	return call_user_func($interceptor, $value);
}
