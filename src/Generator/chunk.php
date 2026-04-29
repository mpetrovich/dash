<?php

namespace Dash\Generator;

/**
 * @see Dash\chunk()
 */
// @codingStandardsIgnoreLine
function chunk($iterable, $size)
{
	$chunk = [];
	$index = 0;
	$isIndexedArray = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if ($isIndexedArray) {
			$chunk[] = $value;
		}
		else {
			$chunk[$key] = $value;
		}

		if (count($chunk) >= $size) {
			yield $chunk;
			$chunk = [];
		}

		$index++;
	}

	if ($chunk) {
		yield $chunk;
	}
}
