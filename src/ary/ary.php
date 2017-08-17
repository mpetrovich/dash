<?php

namespace Dash;

/**
 * Wraps $callable in a new function that only accepts up to $ary arguments and ignores the rest.
 *
 * @category Function
 * @param callable $callable
 * @param int $ary Number of arguments to accept
 * @return callable New function that, when invoked, will call $callable with up to $ary arguments
 *
 * @example
	$fileExists = ary('file_exists', 1);
	$fileExists('foo.txt', 123, 456);  // file_exists() will only get called with 'foo.txt'
 */
function ary($callable, $ary)
{
	return function () use ($callable, $ary) {
		$ary = \max(0, $ary);
		$args = array_slice(func_get_args(), 0, $ary);
		return call_user_func_array($callable, $args);
	};
}
