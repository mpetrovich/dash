<?php

namespace Dash;

/**
 * Checks whether `$iterable` has any elements for which `$comparator` returns truthy.
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param mixed $target Value to compare
 * @param callable $comparator Invoked with `($target, $value)` for each element in `$iterable`
 * @return boolean true if `$comparator` returns truthy for any element in `$iterable`
 *
 * @alias includes
 *
 * @example With loose equality comparison (the default)
	Dash\contains([1, '2', 3], 2);
	// === true
 *
 * @example With strict equality comparison
	Dash\contains([1, '2', 3], 2, 'Dash\identical');
	// === false
 */
function contains($iterable, $target, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return any($iterable, partial($comparator, $target));
}

function includes()
{
	return call_user_func_array('Dash\contains', func_get_args());
}
