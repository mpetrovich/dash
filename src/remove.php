<?php

namespace Dash;

/**
 * Returns a new iterable with all elements matching `$predicate` removed.
 *
 * @category Collections & iterators
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional)
 * @return array
 *
 * @example
	Dash\remove([1, 2, 3, 4], 'Dash\isEven');
	// === [1, 3]
 */
function remove($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return reject($iterable, $predicate);
}
