<?php

namespace Dash;

/**
 * Iterates over a collection and calls an iteratee function for each element.
 *
 * Any changes to the value, key, or collection from within the iteratee function are not persisted.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param callable $iteratee Invoked with ($value, $key, $iterable) for each element in $iterable.
 *                           If $iteratee returns false, iteration will end and subsequent elements will be skipped.
 * @return mixed $iterable
 *
 * @example
	each([1, 2, 3], function ($value, $index, $array) { // $array[$index] === $value });
 */
function each($iterable, $iteratee)
{
	foreach ($iterable as $key => $value) {
		if (call_user_func($iteratee, $value, $key, $iterable) === false) {
			break;
		}
	}

	return $iterable;
}
