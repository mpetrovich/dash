<?php

namespace Dash;

/**
 * @incomplete
 * Returns the key & value of the first element for which $predicate returns truthy.
 *
 * @category Iterable
 * @param iterable|stdClass $iterable
 * @param callable|mixed $predicate Value to compare against, or callable invoked with ($value, $key, $iterable)
 * @return array|null [$key, $value] of the matching key/index and value, or null if not found
 *
 * @example With comparison value
	$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
	find($array, 3);  // === ['c', 3]
	find($array, 'Dash\isEven');  // === ['b', 2]
 */
function find($iterable, $predicate)
{
	$predicate = is_callable($predicate) ? $predicate : partial('Dash\equal', $predicate);

	foreach ($iterable as $key => $value) {
		$found = call_user_func($predicate, $value, $key, $iterable);
		if ($found) {
			return [$key, $value];
		}
	}

	return null;
}
