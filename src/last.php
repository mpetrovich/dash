<?php

namespace Dash;

/**
 * Gets the value of the last element in `$iterable`.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @example
	Dash\last(['a' => 'one', 'b' => 'two', 'c' => 'three']);
	// === 'three'

	Dash\last([]);
	// === null
 */
function last($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return null;
	}

	$value = null;

	foreach ($iterable as $value) {
	}

	return $value;
}
