<?php

namespace Dash;

/**
 * @incomplete
 * Returns a subset of $iterable taken from the beginning until $predicate returns falsey.
 *
 * @param iterable|stdClass $iterable
 * @param callable $predicate Invoked with ($value, $key)
 * @return array|object Array for array-like $iterable, object for object-like $iterable
 *
 * @example
	takeWhile([2, 4, 6, 7, 8, 10], 'Dash\isEven');
	// === [2, 4, 6]
 */
function takeWhile($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return Generator\takeWhile($iterable, $predicate);
	}

	$keys = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			$keys[] = $key;
		}
		else {
			break;
		}
	}

	return pick($iterable, $keys);
}
