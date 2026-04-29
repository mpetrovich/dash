<?php

namespace Dash\Generator;

/**
 * @see Dash\initial()
 */
// @codingStandardsIgnoreLine
function initial($iterable)
{
	$index = 0;
	$isIndexedArray = true;
	$hasPrev = false;
	$prevKey = null;
	$prevValue = null;
	$prevWasIndexed = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if ($hasPrev) {
			if ($prevWasIndexed) {
				yield $prevValue;
			}
			else {
				yield $prevKey => $prevValue;
			}
		}

		$prevKey = $key;
		$prevValue = $value;
		$prevWasIndexed = $isIndexedArray;
		$hasPrev = true;
		$index++;
	}
}
