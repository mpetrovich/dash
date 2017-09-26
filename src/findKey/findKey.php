<?php

namespace Dash;

/**
 * @incomplete
 * Returns the key of the first element for which $predicate returns truthy.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param callable|mixed $predicate Value to compare against, or callable invoked with ($value, $key, $iterable)
 * @return string|integer|null Key of the matching element, or null if not found
 *
 * @example With comparison value
	$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
	find($array, 3);  // === 'c'
	find($array, 'Dash\isEven');  // === 'b'
 */
function findKey($iterable, $predicate)
{
	list($key, $value) = find($iterable, $predicate);
	return $key;
}
