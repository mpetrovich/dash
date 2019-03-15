<?php

namespace Dash;

/**
 * Gets the element values of `$iterable` as an associative array indexed by `$iteratee`.
 *
 * A later value will overwrite an earlier value that has the same key.
 *
 * @see groupBy()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable|string $iteratee (optional) If a callable, invoked with `($value, $key, $iterable)`
 *                                  for each element in `$iterable`;
 *                                  if a string, will use `Dash\property($iteratee)` as the iteratee
 * @return array A new associative array
 *
 * @alias indexBy
 *
 * @example
	$data = [
		['first' => 'John', 'last' => 'Doe'],
		['first' => 'Alice', 'last' => 'Hart'],
		['first' => 'Jane', 'last' => 'Smith'],
		['first' => 'Peter', 'last' => 'Gibbons'],
		['first' => 'Fred', 'last' => 'Durst'],
	];

	Dash\keyBy($data, function ($value) {
		return $value['first'] . ' ' . $value['last'];
	});
	// === [
		'John Doe' => ['first' => 'John', 'last' => 'Doe'],
		'Alice Hart' => ['first' => 'Alice', 'last' => 'Hart'],
		'Jane Smith' => ['first' => 'Jane', 'last' => 'Smith'],
		'Peter Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
		'Fred Durst' => ['first' => 'Fred', 'last' => 'Durst'],
	]

 * @example With a path `$iteratee`
	$data = [
		['first' => 'John', 'last' => 'Doe'],
		['first' => 'Alice', 'last' => 'Hart'],
		['first' => 'Jane', 'last' => 'Smith'],
		['first' => 'Peter', 'last' => 'Gibbons'],
		['first' => 'Fred', 'last' => 'Durst'],
	];

	Dash\keyBy($data, 'last');
	// === [
		'Doe' => ['first' => 'John', 'last' => 'Doe'],
		'Hart' => ['first' => 'Alice', 'last' => 'Hart'],
		'Smith' => ['first' => 'Jane', 'last' => 'Smith'],
		'Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
		'Durst' => ['first' => 'Fred', 'last' => 'Durst'],
	]
 */
function keyBy($iterable, $iteratee = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($iterable)) {
		return [];
	}

	$keyed = [];

	foreach ($iterable as $key => $value) {
		if (hasDirect($value, $iteratee)) {
			$newKey = getDirect($value, $iteratee);
		}
		else {
			$mapper = is_callable($iteratee) ? $iteratee : property($iteratee, null);
			$newKey = call_user_func($mapper, $value, $key, $iterable);
		}
		$keyed[$newKey] = $value;
	}

	return $keyed;
}

function indexBy()
{
	return call_user_func_array('Dash\keyBy', func_get_args());
}
