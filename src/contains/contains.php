<?php

namespace Dash;

/**
 * Checks whether $iterable has any $item values for which $comparator($target, $item) is truthy.
 *
 * @param iterable $iterable
 * @param mixed $target Value to compare $iterable items with
 * @param callable $comparator Invoked with ($target, $item) for each $item value in $iterable
 * @return bool true if $comparator returns truthy for any items in $iterable
 *
 * @example With loose equality comparison (the default)
	contains([1, '2', 3], 2);  // === true
 *
 * @example With strict equality comparison
	contains([1, '2', 3], 2, 'Dash\identity');  // === false
 */
function contains($iterable, $target, $comparator = 'Dash\equal')
{
	return any($iterable, partial($comparator, $target));
}
