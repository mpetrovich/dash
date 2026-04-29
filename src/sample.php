<?php

namespace Dash;

/**
 * Returns a random value from `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null
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
