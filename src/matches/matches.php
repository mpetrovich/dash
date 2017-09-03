<?php

namespace Dash;

/**
 * Creates a function with signature (iterable $iterable) that returns true if $iterable contains
 * all key-value pairs in $properties, using loose equality for value comparison.
 *
 * @category Collection
 * @param iterable $properties Key-value pairs that the returned function will match its input against
 * @return callable with signature (iterable $iterable)
 *
 * @example
	$matcher = matches(['b' => 2, 'd' => 4]);
	$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
	$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'e' => 5]);  // === false
 */
function matches($properties)
{
	$matches = function ($iterable) use ($properties) {
		foreach ($properties as $propertyName => $propertyValue) {
			if (get($iterable, $propertyName) != $propertyValue) {
				return false;
			}
		}

		return true;
	};

	return $matches;
}
