<?php

namespace Dash;

/**
 * Returns values from `$iterable` that have no match in `$other`, using `$comparator` for equality (like `Dash\equal`).
 *
 * Order and keys follow `$iterable`. Indexed inputs yield a reindexed array.
 *
 * @category Collections & iterators
 *
 * @see difference(), intersectionWith()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $other
 * @param callable $comparator (optional) Invoked as `($a, $b)`; truthy means values are considered equal
 * @return array
 *
 * @example
	Dash\differenceWith(
		[['x' => 1], ['x' => 2], ['x' => 1]],
		[['x' => 2]],
		function ($a, $b) {
			return $a['x'] === $b['x'];
		}
	);
	// === [['x' => 1]]
 */
function differenceWith($iterable, $other, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($other, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$a = toArray($iterable);
	$b = toArray($other);

	$out = [];

	foreach ($a as $key => $value) {
		$found = false;

		foreach ($b as $otherValue) {
			if (call_user_func($comparator, $value, $otherValue)) {
				$found = true;
				break;
			}
		}

		if (!$found) {
			$out[$key] = $value;
		}
	}

	return isIndexedArray($iterable) ? array_values($out) : $out;
}
