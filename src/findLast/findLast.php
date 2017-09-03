<?php

namespace Dash;

/**
 * Returns the key & value of the last element for which $predicate returns truthy.
 *
 * @category Collection
 * @param iterable $iterable
 * @param callable|mixed $predicate Value to compare against, or callable invoked with ($value, $key, $iterable)
 * @return array|null [$key, $value] of the matching key/index and value, or null if not found
 *
 * @example With comparison value
	$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
	find($array, 3);  // === ['c', 3]
	find($array, 'Dash\isEven');  // === ['d', 4]
 */
function findLast($iterable, $predicate)
{
	return find(reverse($iterable), $predicate);
}
