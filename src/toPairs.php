<?php

namespace Dash;

/**
 * Converts `$iterable` to a list of `[key, value]` tuples.
 *
 * @see values(), keys()
 *
 * @param iterable|stdClass|null $iterable
 * @return array
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
