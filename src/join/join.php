<?php

namespace Dash;

/**
 * Concatenates all elements in $iterable to a string, each separated by $separator.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param string $separator
 * @return string
 *
 * @example
	join([123, 456, 789], '-');  // === '123-456-789'
 */
function join($iterable, $separator)
{
	return implode($separator, toArray($iterable));
}
