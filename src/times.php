<?php

namespace Dash;

/**
 * Calls `$iteratee` `$n` times with each 0-based index and returns collected results.
 *
 * @category Collections & iterators
 *
 * @param numeric $n
 * @param callable $iteratee (optional)
 * @return array
 */
function times($n, $iteratee = 'Dash\identity')
{
	assertType($n, 'numeric', __FUNCTION__);

	$count = intval($n);

	if ($count <= 0) {
		return [];
	}

	$out = [];

	for ($i = 0; $i < $count; $i++) {
		$out[] = call_user_func($iteratee, $i);
	}

	return $out;
}
