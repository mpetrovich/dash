<?php

namespace Dash;

/**
 * Picks elements of `$iterable` for which `$predicate` returns truthy, always preserving keys.
 *
 * @see filter(), omitBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|array $predicate (optional) Same forms as `filter()`
 * @return array|iterable
 */
function pickBy($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\pickBy($iterable, $predicate);
	}

	if (is_null($iterable)) {
		return [];
	}

	if (!is_callable($predicate)) {
		$predicate = call_user_func_array('Dash\matchesProperty', (array) $predicate);
	}

	$out = [];

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key, $iterable)) {
			$out[$key] = $value;
		}
	}

	return $out;
}
