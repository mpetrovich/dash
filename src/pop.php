<?php

namespace Dash;

/**
 * Returns the last value removed from `$iterable` (PHP-style pop behavior).
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null
 */
function pop($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return last($iterable);
}
