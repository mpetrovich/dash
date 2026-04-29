<?php

namespace Dash;

/**
 * Like `reduce()`, but returns all intermediate accumulator values from left to right.
 *
 * Output begins with `$initial`, then one accumulator value per element.
 *
 * @category Collections & iterators
 *
 * @see reduce()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $iteratee Called with `($result, $value, $key)` for each element
 * @param mixed $initial (optional) Initial value
 * @return array|iterable
 */
function scan($iterable, $iteratee, $initial = [])
{
	assertType($iterable, ['Generator', 'iterable', 'stdClass', 'null'], __FUNCTION__);

	if ($iterable instanceof \Generator) {
		return \Dash\Generator\scan($iterable, $iteratee, $initial);
	}

	$result = $initial;
	$out = [$result];

	foreach ((array) toArray($iterable) as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
		$out[] = $result;
	}

	return $out;
}
