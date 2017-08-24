<?php

namespace Dash;

/**
 * Returns the last value of $iterable.
 *
 * @category Iterable
 * @param iterable $iterable
 * @return mixed
 *
 * @example
	last(['a' => '1st', 'b' => '2nd', 'c' => '3rd']);  // === '3rd'
 */
function last($iterable)
{
	$value = null;
	foreach ($iterable as $value) {
	}
	return $value;
}
