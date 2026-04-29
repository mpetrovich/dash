<?php

namespace Dash\Generator;

/**
 * @see Dash\compact()
 */
// @codingStandardsIgnoreLine
function compact($iterable)
{
	$index = 0;
	$isIndexedArray = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if (!$value) {
			$index++;
			continue;
		}

		if ($isIndexedArray) {
			yield $value;
		}
		else {
			yield $key => $value;
		}

		$index++;
	}
}
