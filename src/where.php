<?php

namespace Dash;

/**
 * Returns all elements of `$iterable` containing key-value pairs that loosely equal `$properties`.
 *
 * @see matches(), filter()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $properties
 * @return array
 *
 * @example
	$input = [
		['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
		['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
		['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
		['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
		['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
	];
	Dash\where($input, ['gender' => 'f', 'age' => 30]);
	// === [
		['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
		['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
	]
 */
function where($iterable, $properties)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($properties, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$matches = matches($properties);
	$results = [];

	foreach ($iterable as $key => $value) {
		if ($matches($value)) {
			$results[$key] = $value;
		}
	}

	return isIndexedArray($iterable) ? array_values($results) : $results;
}
