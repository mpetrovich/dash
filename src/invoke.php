<?php

namespace Dash;

/**
 * Invokes a method/callable at `$path` for each element in `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string|integer $path
 * @param mixed ...$args
 * @return array
 */
function invoke($iterable, $path /*, ...$args */)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$args = array_slice(func_get_args(), 2);
	$results = [];

	foreach ((array) $iterable as $key => $value) {
		$callable = get($value, $path);
		$results[$key] = is_callable($callable) ? call_user_func_array($callable, $args) : null;
	}

	return $results;
}
