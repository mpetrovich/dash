<?php

namespace Dash;

/**
 * Returns a new associative array with keys transformed by `$iteratee`, keeping original values.
 *
 * Later key collisions overwrite earlier entries.
 *
 * @see mapValues(), keyBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|integer $iteratee (optional) Same forms as `mapValues()`
 * @return array|iterable
 */
function mapKeys($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\mapKeys($iterable, $iteratee);
	}

	if (is_null($iterable)) {
		return [];
	}

	$out = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$newKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}

		$out[$newKey] = $value;
	}

	return $out;
}
