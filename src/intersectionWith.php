<?php

namespace Dash;

/**
 * Returns values from `$iterable` that match some value in `$other`, using `$comparator` for equality
 * (like `Dash\equal`).
 *
 * Order and keys follow `$iterable`. Indexed inputs yield a reindexed array.
 *
 * @category Collections & iterators
 *
 * @see intersection(), differenceWith()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $other
 * @param callable $comparator (optional) Invoked as `($a, $b)`; truthy means values are considered equal
 * @return array
 *
 * @example
	Dash\intersectionWith(
		[['x' => 1], ['x' => 2]],
		[['x' => 2]],
		function ($a, $b) {
			return $a['x'] === $b['x'];
		}
	);
	// === [['x' => 2]]
 */
function intersectionWith($iterable, $other, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($other, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$a = toArray($iterable);
	$b = toArray($other);

	$out = [];

	foreach ($a as $key => $value) {
		foreach ($b as $otherValue) {
			if (call_user_func($comparator, $value, $otherValue)) {
				$out[$key] = $value;
				break;
			}
		}
	}

	return isIndexedArray($iterable) ? array_values($out) : $out;
}
