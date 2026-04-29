<?php

namespace Dash;

/**
 * Returns the first value removed from `$iterable` (PHP-style shift behavior).
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null
 */
function shift($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return first($iterable);
}
