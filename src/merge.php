<?php

namespace Dash;

/**
 * Returns a new shallow-merged array from one or more iterables.
 *
 * Later sources overwrite earlier keys.
 *
 * @category Objects & paths
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null ...$sources
 * @return array
 */
function merge($iterable /* , ...$sources */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$arrays = map(func_get_args(), function ($value) {
		assertType($value, ['iterable', 'stdClass', 'null'], 'Dash\merge');
		return toArray($value);
	});

	return call_user_func_array('array_merge', $arrays);
}
