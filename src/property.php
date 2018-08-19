<?php

namespace Dash;

/**
 * Creates a function that returns the value at a `$path` for a given input.
 *
 * @category Iterable
 * @param string|number|null $path Path of the property to retrieve;
 *                                 can be nested by delimiting each sub-property or array index with a period.
 * @param mixed $default (optional) Default value to return if nothing exists at `$path`
 * @return function Function with signature `($input)` that returns the value at `$path` within `$input`
 *
 * @example Accepts arrays and objects
	$getter = Dash\property('foo');
	$getter(['foo' => 'value']);  // === 'value'
	$getter((object) ['foo' => 'value']);  // === 'value'
 *
 * @example Methods can be accessed too
	$getter = Dash\property('items.count');
	$countFn = $getter(['items' => new ArrayObject([1, 2, 3])]);
	$countFn();  // === 3
 *
 * @example Nested properties can be referenced with dot notation
	$getter = Dash\property('a.b.c');
	$getter([
		'a' => [
			'b' => [
				'c' => 'value'
			]
		]
	]);
	// === 'value'
 *
 * @example Array elements can be referenced by index
	$getter = Dash\property('items.1.name');
	$getter([
		'items' => [
			['name' => 'one'],
			['name' => 'two'],
			['name' => 'three'],
		]
	]);
	// === 'two'
 *
 * @example Keys with the same name as the full path can be used
	$getter = Dash\property('a.b.c');
	$getter(['a.b.c' => 'value']);  // === 'value'
 */
function property($path, $default = null)
{
	assertType($path, ['string', 'numeric', 'null'], __FUNCTION__);

	$getter = function ($input) use ($path, $default) {
		// Short-circuit for direct properties
		if (hasDirect($input, $path)) {
			return getDirect($input, $path);
		}

		$result = $input;
		$steps = explode('.', $path);

		foreach ($steps as $step) {
			if (hasDirect($result, $step)) {
				$result = getDirect($result, $step);
			}
			else {
				$result = $default;
				break;
			}
		}

		return $result;
	};

	return $getter;
}

/**
 * @codingStandardsIgnoreStart
 */
function _property(/* default, $path */)
{
	return currify('Dash\property', func_get_args());
}
