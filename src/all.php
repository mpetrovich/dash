<?php

namespace Dash;

/**
 * Checks whether $predicate returns truthy for every item in $input.
 * $predicate will be called with ($value, $key).
 *
 * @category Collection
 * @param mixed $input Any iterable
 * @param callable $predicate
 * @return bool true if $predicate returns truthy for every item in $input
 *
 * @example
	all([1, 2, 3], function($n) { return $n < 3; });  // === false
	all([1, 2, 3], function($n) { return $n < 4; });  // === true

	all([1, 2, 3], 'Dash\isOdd');  // === false
	all([1, 3, 5], 'Dash\isOdd');  // === true
 */
function all($input, $predicate)
{
	return every($input, $predicate);
}
