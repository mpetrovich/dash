<?php

namespace Dash;

/**
 * Returns the first value of $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return mixed
 *
 * @example
	first(['a' => '1st', 'b' => '2nd', 'c' => '3rd']);  // === '1st'
 */
function first($iterable)
{
	foreach ($iterable as $value) {
		return $value;
	}
}
