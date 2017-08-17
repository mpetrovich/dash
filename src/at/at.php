<?php

namespace Dash;

/**
 * Gets the value at the $index-th value of $iterable, ignoring key values.
 * @todo Revisit implementation
 *
 * @category Array
 * @param iterable $iterable
 * @param int|string $index
 * @return mixed
 *
 * @example
	at([1, 3, 5, 8], 2);  // === 5
 *
 * @example Keys are ignored; the literal i-th position is returned
	at([3 => 'a', 2 => 'b', 1 => 'c', 0 => 'd'], 2);  // === 'c'
 */
function at($iterable, $index)
{
	$at = null;

	$i = 0;
	foreach ($iterable as $key => $value) {
		$at = $value;
		if ($i === intval($index)) {
			break;
		}
		$i++;
	}

	return $at;
}
