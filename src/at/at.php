<?php

namespace Dash;

/**
 * Gets the value of the literal $index-th element of $iterable, ignoring key values.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param int $index 0-based index
 * @param mixed $default Value to return if $index is out of bounds
 * @return mixed
 *
 * @example
	at(['a', 'b', 'c', 'd'], 2);  // === 'c'
 *
 * @example Keys are ignored; the literal i-th position is returned
	$input = (object) ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'];
	at($input, 2);  // === 'three'
 */
function at($iterable, $index, $default = null)
{
	$values = values($iterable);
	return isset($values[$index]) ? $values[$index] : $default;
}
