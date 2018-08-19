<?php

namespace Dash;

/**
 * Creates a function that returns whether `$comparator` returns truthy for the value at `$path` for a given input.
 *
 * @category Iterable
 * @param callable|string|number|null $path Any valid path supported by `Dash\get()`
 * @param mixed $value Value passed to `$comparator` for comparison
 * @param callable $comparator (optional) Function with signature `($valueAtPath, $value)` that
 *                             compares `$value` to the value at `$path` for the given input
 * @return function Function with signature `($input)` that returns whether the value at `$path` within `$input`
 *                  for which `$comparator($valueAtPath, $value)` returns truthy
 *
 * @example Matches truthy field value
	$matcher = Dash\matchesProperty('foo');
	$matcher(['foo' => 'bar']);  // === true
	$matcher(['foo' => null]);   // === false
 *
 * @example Matches falsey field value
	$matcher = Dash\matchesProperty('foo', false);
	$matcher(['foo' => false]);  // === true
	$matcher(['foo' => 'bar']);  // === false
 *
 * @example Matches field value that loosely equals a given value
	$matcher = Dash\matchesProperty('foo', 3);
	$matcher(['foo' => 3.0]);  // === true
	$matcher(['foo' => 4]);   // === false
 *
 * @example Matches field value for which a given comparator returns true
	$matcher = Dash\matchesProperty('foo', 3, 'Dash\identical');
	$matcher(['foo' => 3]);    // === true
	$matcher(['foo' => 3.0]);  // === false
 */
function matchesProperty($path, $value = true, $comparator = 'Dash\equal')
{
	return function ($input) use ($path, $value, $comparator) {
		return call_user_func($comparator, get($input, $path), $value);
	};
}

/**
 * @codingStandardsIgnoreStart
 */
function _matchesProperty(/* value, comparator, path */)
{
	return currify('Dash\matchesProperty', func_get_args());
}
