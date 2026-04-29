<?php

namespace Dash;

/**
 * Inverse of `zip()`: turns an iterable of tuples into parallel arrays (columns).
 *
 * @alias transpose
 *
 * @param iterable|stdClass|null $iterable Iterable of rows (each row an iterable of cells)
 * @return array A list of arrays; each inner array is one column across rows.
 *
 * @example
	Dash\unzip([[1, 10], [2, 20], [3, 30]]);
	// === [[1, 2, 3], [10, 20, 30]]
 */
function unzip($iterable)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$rows = toArray($iterable);

	if (empty($rows)) {
		return [];
	}

	return zip(...$rows);
}

function transpose()
{
	return call_user_func_array('Dash\unzip', func_get_args());
}
