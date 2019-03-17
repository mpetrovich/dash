<?php

namespace Dash;

/**
 * Invokes `$interceptor` with `($value)` and returns `$value` unchanged.
 *
 * Note: Any changes made to `$value` in `$interceptor` will not be returned.
 *
 * @param mixed $value
 * @param callable $interceptor Invoked with `($value)`
 * @return mixed Original `$value`
 *
 * @example
	$result = Dash\chain([1, 3, 4])
		->filter('Dash\isOdd')
		->tap(function ($value) {
			// $value === [1, 3]
			print_r($value);
		})
		->value();

	// $result === [1, 3]
 */
function tap($value, callable $interceptor)
{
	call_user_func($interceptor, $value);
	return $value;
}
