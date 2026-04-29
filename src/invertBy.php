<?php

namespace Dash;

/**
 * Like `invert()`, but groups original keys into arrays by transformed value.
 *
 * @see invert(), mapKeys()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|integer $iteratee (optional) Same forms as `mapValues()`
 * @return array
 */
function invertBy($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$out = [];

	foreach (toArray($iterable) as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$newKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}

		$out[(string) $newKey][] = $key;
	}

	return $out;
}
