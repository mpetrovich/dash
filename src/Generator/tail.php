<?php

namespace Dash\Generator;

/**
 * @see Dash\tail()
 */
// @codingStandardsIgnoreLine
function tail($iterable)
{
	$index = 0;
	$isIndexedArray = true;
	$skip = true;

	foreach ($iterable as $key => $value) {
		$isIndexedArray = $isIndexedArray && ($key === $index);

		if ($skip) {
			$skip = false;
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
