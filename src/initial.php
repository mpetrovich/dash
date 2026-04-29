<?php

namespace Dash;

/**
 * Returns all elements of `$iterable` except the last.
 *
 * Keys are preserved unless `$iterable` is an indexed array. An empty or single-element iterable yields an empty array.
 *
 * @see last(), tail()
 *
 * @param iterable|stdClass|null $iterable
 * @return array|iterable
 *
 * @alias init
 *
 * @example
	Dash\initial([1, 2, 3]);
	// === [1, 2]

	Dash\initial([1]);
	// === []
 */
function initial($iterable)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\initial($iterable);
	}

	if (is_null($iterable)) {
		return [];
	}

	$array = toArray($iterable);

	if (!$array) {
		return [];
	}

	array_pop($array);

	return isIndexedArray($iterable) ? array_values($array) : $array;
}

function init()
{
	return call_user_func_array('Dash\initial', func_get_args());
}
