<?php

namespace Dash;

/**
 * Checks whether $iterable has any elements for which $comparator returns truthy.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param mixed $target Value to compare $iterable elements against
 * @param callable $comparator Invoked with ($target, $value) for each value in $iterable
 * @return boolean true if $comparator returns truthy for any elements in $iterable
 *
 * @example With loose equality comparison (the default)
	contains([1, '2', 3], 2);  // === true
 *
 * @example With strict equality comparison
	contains([1, '2', 3], 2, 'Dash\identical');  // === false
 */
function contains($iterable, $target, $comparator = 'Dash\equal')
{
	return any($iterable, partial($comparator, $target));
}
