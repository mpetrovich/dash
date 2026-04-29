<?php

namespace Dash;

/**
 * Creates a predicate that checks whether an input contains all key-value pairs in `$properties`.
 *
 * Uses loose equality for value comparison and supports nested paths via `get()`.
 *
 * @param iterable|stdClass|null $properties
 * @return callable with signature `($iterable): boolean`
 *
 * @example
	$matcher = Dash\matches(['b' => 2, 'd' => 4]);
	$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
	$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'e' => 5]);  // === false
 */
function matches($properties)
{
	assertType($properties, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$properties = toArray($properties);

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
