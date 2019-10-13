<?php

namespace Dash;

/**
 * Returns a new array containing the unique values, in order, of the provided iterable.
 *
 * Non-indexed keys are preseved, but duplicate keys will overwrite previous ones.
 *
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @alias distinct
 *
 * @example With indexed arrays
	Dash\unique([1, 2, 2, 3, 1]);
	// === [1, 2, 3]
 *
 * @example With associative arrays
	Dash\unique(['a' => 1, 'b' => 2, 'c' => 1]);
	// === ['a' => 1, 'b' => 2]
 */
function unique($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	return union($iterable);
}

function distinct()
{
	return call_user_func_array('Dash\unique', func_get_args());
}
