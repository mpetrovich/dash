<?php

namespace Dash;

/**
 * Checks whether any element in `$iterable` matches all key-value pairs in `$properties`.
 *
 * Equivalent to `any($iterable, matches($properties))`.
 *
 * @category Predicates & comparison
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $properties
 * @return boolean
 */
function matchesAny($iterable, $properties)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($properties, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return any($iterable, matches($properties));
}
