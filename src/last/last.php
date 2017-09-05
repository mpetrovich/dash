<?php

namespace Dash;

/**
 * Gets the value of the last element in `$iterable`.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
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
	assertType($iterable, ['iterable', 'stdClass'], __FUNCTION__);

	$value = null;

	foreach ($iterable as $value) {
	}

	return $value;
}

/**
 * @codingStandardsIgnoreStart
 */
function _last(/* iterable */)
{
	return currify('Dash\last', func_get_args());
}
