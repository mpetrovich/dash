<?php

namespace Dash;

/**
 * Checks whether $predicate returns truthy for every item in $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param callable $predicate Invoked with ($value, $key) that returns a boolean
 * @return boolean true if $predicate returns truthy for every item in $iterable
 *
 * @see every
 *
 * @example
	all([1, 2, 3], function($n) { return $n > 5; });  // === false
	all([1, 3, 5], 'Dash\isOdd');  // === true
 */
function all($iterable, $predicate)
{
	if (isEmpty($iterable)) {
		return true;
	}

	return !any($iterable, negate($predicate));
}

/**
 * @codingStandardsIgnoreStart
 */
function _all(/* predicate, iterable */)
{
	return currify('Dash\all', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function every()
{
	return call_user_func_array('Dash\all', func_get_args());
}

/**
 * @codingStandardsIgnoreStart
 */
function _every(/* predicate, iterable */)
{
	return currify('Dash\all', func_get_args());
}
