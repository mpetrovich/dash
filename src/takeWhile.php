<?php

namespace Dash;

/**
 * Returns a subset of `$iterable` taken from the beginning while `$predicate` returns truthy.
 *
 * @see dropWhile()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $predicate (optional) Invoked with `($value, $key, $iterable)`
 * @return array|iterable
 *
 * @example
	Dash\takeWhile([2, 4, 6, 7, 8, 10], 'Dash\isEven');
	// === [2, 4, 6]
 */
function takeWhile($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return Generator\takeWhile($iterable, $predicate);
	}

	if (is_null($iterable)) {
		return [];
	}

	$keys = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$keys[] = $key;
		}
		else {
			break;
		}
	}

	return pick($iterable, $keys);
}
