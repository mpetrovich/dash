<?php

namespace Dash;

/**
 * Returns all elements of `$iterable` except the first.
 *
 * Keys are preserved unless `$iterable` is an indexed array. An empty iterable yields an empty array.
 *
 * @see first(), initial()
 *
 * @param iterable|stdClass|null $iterable
 * @return array|iterable
 *
 * @alias rest
 *
 * @example
	Dash\tail([1, 2, 3]);
	// === [2, 3]

	Dash\tail([1]);
	// === []
 */
function tail($iterable)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\tail($iterable);
	}

	if (is_null($iterable)) {
		return [];
	}

	$array = toArray($iterable);

	if (!$array) {
		return [];
	}

	if (isIndexedArray($iterable)) {
		return array_slice(array_values($array), 1);
	}

	$keys = array_keys($array);
	array_shift($keys);

	return pick($iterable, $keys);
}

function rest()
{
	return call_user_func_array('Dash\tail', func_get_args());
}
