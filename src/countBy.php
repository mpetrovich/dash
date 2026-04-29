<?php

namespace Dash;

/**
 * Counts elements of `$iterable` by key produced from `$iteratee`.
 *
 * @see groupBy(), keyBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string $iteratee (optional) If a callable, invoked with `($value, $key, $iterable)`
 * @param string $defaultGroup (optional) The key used when `$iteratee` returns `null`
 * @return array A new associative array of `[groupKey => count]`
 */
// phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh -- mirrors groupBy iteratee/path dispatch rules
function countBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$counted = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$newKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}

		$newKey = is_null($newKey) ? $defaultGroup : $newKey;
		$newKey = is_null($newKey) ? '' : $newKey;
		$counted[$newKey] = ($counted[$newKey] ?? 0) + 1;
	}

	return $counted;
}
