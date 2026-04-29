<?php

namespace Dash;

/**
 * Returns a new associative array with keys and values swapped.
 *
 * Later duplicate values overwrite earlier keys.
 *
 * @category Objects & paths
 *
 * @see keys(), values(), invertBy()
 *
 * @param iterable|stdClass|null $iterable
 * @return array
 *
 * @example
	Dash\invert(['a' => 1, 'b' => 2, 'c' => 1]);
	// === ['1' => 'c', '2' => 'b']  (later duplicate values win)
 *
 * @alias invertObj
 */
function invert($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$out = [];

	foreach (toArray($iterable) as $key => $value) {
		$out[(string) $value] = $key;
	}

	return $out;
}

function invertObj()
{
	return call_user_func_array('Dash\invert', func_get_args());
}
