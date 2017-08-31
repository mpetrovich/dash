<?php

namespace Dash;

/**
 * Checks whether $predicate returns truthy for any item in $iterable.
 *
 * @category Iterable
 * @param mixed $iterable
 * @param callable $predicate A callable invoked with ($value, $key) that returns a boolean
 * @return boolean
 *
 * @example
	all([1, 2, 3], function($n) { return $n > 5; });  // === false
	all([1, 2, 3], 'Dash\isEven');  // === true
 */
function any($iterable, $predicate)
{
	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			return true;
		}
	}

	return false;
}
