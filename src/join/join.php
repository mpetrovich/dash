<?php

namespace Dash;

/**
 * Concatenates all elements in $iterable to a string, each separated by $separator.
 *
 * @category Collection
 * @param iterable $iterable
 * @param string $separator
 * @return string
 *
 * @see implode
 *
 * @example
	join([123, 456, 789], '-');  // === '123-456-789'
 */
function join($iterable, $separator)
{
	return \implode($separator, toArray($iterable));
}

/**
 * @codingStandardsIgnoreStart
 */
function implode()
{
	return call_user_func_array('Dash\join', func_get_args());
}
