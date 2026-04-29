<?php

namespace Dash;

/**
 * Gets the `$n`th element of `$iterable` (by iteration order, ignoring keys).
 * Negative `$n` counts from the end (`-1` is the last element).
 *
 * @see at(), first(), last()
 *
 * @param iterable|stdClass|null $iterable
 * @param integer $index
 * @param mixed $default (optional) Returned when the index is out of bounds
 * @return mixed
 *
 * @example
	Dash\nth([10, 20, 30], 1);
	// === 20

	Dash\nth([10, 20, 30], -1);
	// === 30
 */
function nth($iterable, $index, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($index, 'numeric', __FUNCTION__);

	if (is_null($iterable)) {
		return $default;
	}

	$values = values($iterable);
	$length = count($values);

	if ($index < 0) {
		$index += $length;
	}

	return isset($values[$index]) ? $values[$index] : $default;
}
