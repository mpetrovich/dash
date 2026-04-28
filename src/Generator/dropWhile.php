<?php

namespace Dash\Generator;

/**
 * @see Dash\dropWhile()
 */
// @codingStandardsIgnoreLine
function dropWhile($iterable, $predicate = 'Dash\identity')
{
	$done = false;
	$index = 0;
	$isIndexedArray = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if (!$done && call_user_func($predicate, $value, $key, $iterable)) {
			$index++;
			continue;
		}

		$done = true;
		if ($isIndexedArray) {
			yield $value;
		}
		else {
			yield $key => $value;
		}

		$index++;
	}
}
