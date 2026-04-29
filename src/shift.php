<?php

namespace Dash;

/**
 * Returns the first value removed from `$iterable` (PHP-style shift behavior).
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null
 *
 * @example
	Dash\shift([1, 2, 3]);
	// === 1
 */
function shift($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return first($iterable);
}
