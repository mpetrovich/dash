<?php

namespace Dash;

/**
 * @incomplete
 * Like get(), but if the resolved value is callable, it will invoke the callable and return its result.
 *
 * @category Iterable
 * @param array|object $iterable
 * @param callable|string $path Callable used to retrieve the value or path of the property to retrieve;
 *                              Paths can be nested by delimiting each sub-property or array index with a period,
 *                              eg. 'a.b.0.c'
 * @param mixed $default Default value to return if nothing exists at $path
 *
 * @return mixed Value at $path on the collection
 *
 * @example
	$iterable = [
		'a' => [
			'b' => 'value'
		]
	];
	result($iterable, 'a.b');
	// === 'value'
 *
 * @example Array elements can be referenced by index
	$iterable = [
		'people' => [
			['name' => 'Pete'],
			['name' => 'John'],
			['name' => 'Paul'],
		]
	];
	result($iterable, 'people.1.name');
	// === 'John'
 *
 * @example Keys with the same name as the full path can be used
	$iterable = ['a.b.c' => 'value'];
	result($iterable, 'a.b.c');
	// === 'value'
 *
 * @example With a callable value
	$iterable = [
		'dates' => [
			'start' => new DateTime('2017-01-01'),
			'end' => new DateTime('2017-01-03'),
		]
	]
	result($iterable, 'dates.start.getTimestamp');
	// === 1483246800
 */
function result($iterable, $path, $default = null)
{
	$value = get($iterable, $path, $default);

	if (is_callable($value)) {
		$value = call_user_func($value);
	}

	return $value;
}
