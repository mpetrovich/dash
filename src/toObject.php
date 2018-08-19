<?php

namespace Dash;

/**
 * Gets a plain object representation of `$value`.
 *
 * @category Iterable
 * @param mixed $value
 * @return object Empty object if `$value` is not iterable
 *
 * @example
	Dash\toObject(['a' => 1, 'b' => 2]);
	// === (object) ['a' => 1, 'b' => 2]

	Dash\toObject(new ArrayObject(['a' => 1, 'b' => 2]));
	// === (object) ['a' => 1, 'b' => 2]
 */
function toObject($value)
{
	return (object) toArray($value);
}
