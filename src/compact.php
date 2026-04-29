<?php

namespace Dash;

/**
 * Gets a list of truthy elements in `$iterable`.
 *
 * This is equivalent to `filter($iterable, 'Dash\identity')`.
 * Keys are preserved unless `$iterable` is an indexed array.
 * An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)
 *
 * @param iterable|stdClass|null $iterable
 * @return array|iterable List of truthy elements in `$iterable`
 *
 * @example
	Dash\compact([0, 1, false, 2, '', 3, null]);
	// === [1, 2, 3]
 *
 * @example With associative array
	Dash\compact(['a' => 0, 'b' => 2, 'c' => false, 'd' => 4]);
	// === ['b' => 2, 'd' => 4]
 */
function compact($iterable)
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\compact($iterable);
	}

	return filter($iterable, 'Dash\identity');
}
