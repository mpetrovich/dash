<?php

namespace Dash;

/**
 * Concatenates the string value of all elements in `$iterable`,
 * with each value separated by `$separator`.
 *
 * @param iterable|stdClass|null $iterable
 * @param string $separator
 * @return string
 *
 * @alias implode
 *
 * @example
	Dash\join([123, 456, 789], '-');
	// === '123-456-789'

	Dash\join(['a' => 1, 'b' => 2, 'c' => 3], ', ');
	// === '1, 2, 3'
 */
function join($iterable, $separator)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($separator, 'string', __FUNCTION__);

	return \implode($separator, toArray($iterable));
}

function implode()
{
	return call_user_func_array('Dash\join', func_get_args());
}
