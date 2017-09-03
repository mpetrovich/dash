<?php

namespace Dash;

/**
 * Creates a function with signature (iterable $iterable) that returns true
 * if it has a value at $path that is loosely equal to $value.
 *
 * @category Collection
 * @param string $path Any valid path supported by Dash\get()
 * @param mixed $value Value to compare against
 * @return callable with signature (iterable $iterable)
 *
 * @example
	$matcher = matchesProperty('c', 3);
	$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
	$matcher(['a' => 1, 'b' => 2, 'd' => 4, 'e' => 5]);  // === false
 */
function matchesProperty($path, $value)
{
	$matches = function ($iterable) use ($path, $value) {
		return get($iterable, $path) == $value;
	};

	return $matches;
}
