<?php

namespace Dash;

/**
 * Returns a random value from `$iterable`.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null
 *
 * @example
	Dash\sample([10, 20, 30]);  // one of 10, 20, or 30

	Dash\sample([]);
	// === null
 */
function sample($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$values = values($iterable);
	$count = count($values);

	if ($count === 0) {
		return null;
	}

	return $values[array_rand($values)];
}
