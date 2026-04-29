<?php

namespace Dash;

/**
 * Returns the combined values of `$iterable` and `$other`, in that order, omitting later values that compare equal to an earlier one using `$comparator`.
 *
 * When `$iterable` is indexed, new values are appended and the result is reindexed. Otherwise keys from `$other` are used for appended entries.
 *
 * @see union(), intersectionWith()
 *
 * @param iterable|stdClass|null $iterable
 * @param iterable|stdClass|null $other
 * @param callable $comparator (optional) Invoked as `($a, $b)`; truthy means values are considered equal
 * @return array
 *
 * @example
	Dash\unionWith([1, 3], [2, 1], 'Dash\equal');
	// === [1, 3, 2]
 */
function unionWith($iterable, $other, $comparator = 'Dash\equal')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	assertType($other, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$a = toArray($iterable);
	$b = toArray($other);

	$out = $a;
	$isIndexed = isIndexedArray($iterable);

	foreach ($b as $key => $value) {
		$found = false;

		foreach ($out as $u) {
			if (call_user_func($comparator, $value, $u)) {
				$found = true;
				break;
			}
		}

		if (!$found) {
			if ($isIndexed) {
				$out[] = $value;
			}
			else {
				$out[$key] = $value;
			}
		}
	}

	return $isIndexed ? array_values($out) : $out;
}
