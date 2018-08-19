<?php

namespace Dash;

/**
 * Gets an array of values at `$path` for all elements in `$iterable`.
 *
 * @see map()
 *
 * @category Iterable
 * @param iterable|stdClass|null $iterable
 * @param callable $path Any valid path accepted by `Dash\property()`
 * @param mixed $default (optional) Default value for each element without a value at `$path`
 * @return array New array of plucked values from `$iterable`
 *
 * @example
	$data = [
		['name' => 'John'],
		['name' => 'Mary', 'age' => 35],
		['name' => 'Pete', 'age' => 20],
	];

	Dash\pluck($data, 'name');
	// === ['John', 'Mary', 'Pete']

	Dash\pluck($data, 'age');
	// === [null, 35, 20]
 */
function pluck($iterable, $path, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return map($iterable, property($path, $default));
}

/**
 * @codingStandardsIgnoreStart
 */
function _pluck(/* path, default, iterable */)
{
	return currify('Dash\pluck', func_get_args());
}
