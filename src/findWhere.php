<?php

namespace Dash;

/**
 * Returns all elements of `$iterable` that match all key-value pairs in `$properties`.
 *
 * Equivalent to `filter($iterable, matches($properties))`.
 *
 * @category Collections & iterators
 *
 * @see where(), matches(), filter()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $properties
 * @return array|iterable
 *
 * @example
	$users = [
		['id' => 1, 'role' => 'admin'],
		['id' => 2, 'role' => 'member'],
	];

	Dash\findWhere($users, ['role' => 'member']);
	// === [['id' => 2, 'role' => 'member']]
 */
function findWhere($iterable, $properties)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($properties, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\findWhere($iterable, $properties);
	}

	if (is_null($iterable)) {
		return [];
	}

	return filter($iterable, matches($properties));
}
