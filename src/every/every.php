<?php

namespace Dash;

/**
 * Checks whether $predicate returns truthy for every item in $iterable.
 *
 * @category Iterable
 * @param mixed $iterable
 * @param callable $predicate A callable invoked with ($value, $key) that returns a boolean
 * @return boolean
 *
 * @example
	every([1, 2, 3], function($n) { return $n > 0; });  // === true
	every([1, 2, 3], 'Dash\isOdd');  // === false
 */
function every($iterable, $predicate)
{
	if (isEmpty($iterable)) {
		return true;
	}

	return !any($iterable, negate($predicate));
}
