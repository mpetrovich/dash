<?php

namespace Dash;

/**
 * Omits elements of `$iterable` for which `$predicate` returns truthy, preserving keys.
 *
 * @category Objects & paths
 *
 * @see pickBy(), filter()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) Same forms as `filter()`
 * @return array|iterable
 *
 * @example
	Dash\omitBy(['a' => 1, 'b' => 0, 'c' => 3], function ($n) { return $n < 2; });
	// === ['c' => 3]
 */
function omitBy($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	return pickBy($iterable, negate($predicate));
}
