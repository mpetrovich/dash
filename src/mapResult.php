<?php

namespace Dash;

/**
 * Invokes the callable located at `$path` within each element in `$iterable`,
 * and returns a new array of those callable return values.
 *
 * Unlike `map()`, keys in `$iterable` are preserved.
 *
 * @see map(), mapValues()
 *
 * @param iterable|stdClass|null $iterable
 * @param string $path Returns the result of `Dash\property($path, $default)` for each element
 * @param mixed $default (optional) Default value to return for an element if nothing exists at `$path`
 * @return array A new array with the same keys as `$iterable`
 *
 * @example
	$data = [
		'john' => ['getHash' => function() { return md5('John Doe'); }],
		'jane' => ['getHash' => function() { return md5('Jane Doe'); }],
		'paul' => ['getHash' => function() { return md5('Paul Dyk'); }],
	];
	Dash\mapResult($data, 'getHash');
	// === [
		'john' => '4c2a904bafba06591225113ad17b5cec',
		'jane' => '1c272047233576d77a9b9a1acfdf741c',
		'paul' => '022fbf2743848afb47158d9c80f28d03',
	]
 */
function mapResult($iterable, $path, $default = null)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$results = [];

	foreach ($iterable as $key => $value) {
		$getter = property($path, $default);
		$results[$key] = result($value, $getter, $default);
	}

	return $results;
}
