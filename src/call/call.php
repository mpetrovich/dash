<?php

namespace Dash;

/**
 * Invokes `$callable` with an inline list of arguments.
 *
 * Note: Contrary to other curried methods, the curried version of this method
 * accepts arguments in the same order as the original method.
 *
 * @category Callable
 * @param callable $callable
 * @codingStandardsIgnoreLine
 * @param mixed ...$args Inline arguments to pass to `$callable`
 * @return mixed Return value of `$callable`
 *
 * @example
	$func = function ($time, $name) {
		return "Good $time, $name";
	};

	Dash\call($func, 'morning', 'John');
	// === 'Good morning, John'
 *
 * @example Curried version accepts arguments in the same order
	$func = function ($time, $name) {
		return "Good $time, $name";
	};

	$call = Dash\_call($func);

	$call('morning', 'John');
	// === 'Good morning, John'
 */
function call(callable $callable /* , ...args */)
{
	$args = array_slice(func_get_args(), 1);
	return call_user_func_array($callable, $args);
}

/**
 * @codingStandardsIgnoreStart
 */
function _call(/* callable, ...args */)
{
	$args = array_merge(['Dash\call'], func_get_args());
	return call_user_func_array('Dash\curry', $args);
}
