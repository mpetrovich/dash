<?php

namespace Dash\Generator;

/**
 * @see Dash\slice()
 *
 * @param iterable $iterable
 * @param integer $offset
 * @param integer|null $length
 * @return iterable
 */
function slice($iterable, $offset = 0, $length = null)
{
	$index = 0;
	$yielded = 0;

	foreach ($iterable as $key => $value) {
		if ($index++ < $offset) {
			continue;
		}

		if (!is_null($length) && $yielded >= $length) {
			break;
		}

		yield $key => $value;
		$yielded++;
	}
}
