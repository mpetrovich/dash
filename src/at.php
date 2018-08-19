<?php

namespace Dash;

/**
 * Iterates over `$iterable` and returns the value of the `$index`th element, ignoring keys.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param integer $index 0-based index
 * @param mixed $default (optional) Value to return if `$index` is out of bounds
 * @return mixed Value of the `$index`th item of `$iterable, ignoring keys
 *
 * @example
	Dash\at(['a', 'b', 'c'], 0);
	// === 'a'

	Dash\at([2 => 'a', 1 => 'b', 0 => 'c'], 0);
	// === 'a'

	Dash\at(['a' => 'first', 'b' => 'second', 'c' => 'third'], 2);
	// === 'third'
 *
 * @example With a custom default value
	Dash\at(['a', 'b', 'c'], 5, 'none');
	// === 'none'
 */
function at($iterable, $index, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($index, 'numeric', __FUNCTION__);

	$values = values($iterable);
	return isset($values[$index]) ? $values[$index] : $default;
}
