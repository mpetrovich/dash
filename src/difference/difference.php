<?php

namespace Dash;

/**
 * Returns a subset of items from the first iterable that are not present in any of the other iterables.
 *
 * @category Collection
 * @param iterable $iterable Iterable to compare against
 * @param iterable $iterables,...
 * @return array
 *
 * @see diff
 *
 * @example
	diff(
		[1, 2, 3, 4, 5, 6],
		[1, 3, 5],
		[2, 8]
	);  // === [4, 6]
 */
function difference($iterable /* , ...iterables */)
{
	$iterables = func_get_args();
	$first = array_shift($iterables);
	$diff = [];

	foreach ($first as $key => $value) {
		$found = any($iterables, function ($iterable) use ($value) {
			return contains($iterable, $value);
		});

		if (!$found) {
			$diff[$key] = $value;
		}
	}

	return $diff;
}

/**
 * @codingStandardsIgnoreStart
 */
function diff()
{
	return call_user_func_array('Dash\difference', func_get_args());
}
