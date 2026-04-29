<?php

namespace Dash;

/**
 * Converts `$iterable` to a list of `[key, value]` tuples.
 *
 * @category Collections & iterators
 *
 * @see values(), keys()
 *
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\toPairs(['a' => 1, 'b' => 2]);
	// === [['a', 1], ['b', 2]]
 *
 * @alias pairs
 */
function toPairs($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$pairs = [];

	foreach ((array) $iterable as $key => $value) {
		$pairs[] = [$key, $value];
	}

	return $pairs;
}

function pairs()
{
	return call_user_func_array('Dash\toPairs', func_get_args());
}
