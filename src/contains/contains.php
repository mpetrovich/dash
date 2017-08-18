<?php

namespace Dash;

/**
 * Checks whether $iterable has any elements for which $comparator($target, $element) is truthy.
 *
 * @param iterable $iterable
 * @param mixed $target Value to compare $iterable elements against
 * @param callable $comparator Invoked with ($target, $element) for each $element value in $iterable
 * @return boolean true if $comparator returns truthy for any elements in $iterable
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
