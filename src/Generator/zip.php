<?php

namespace Dash\Generator;

/**
 * @see Dash\zip()
 */
// @codingStandardsIgnoreLine
function zip(/* ...$iterables */)
{
	$args = func_get_args();
	$iters = [];

	foreach ($args as $arg) {
		if (is_null($arg)) {
			$iters[] = new \ArrayIterator([]);
		}
		elseif ($arg instanceof \Generator) {
			$iters[] = $arg;
		}
		else {
			$iters[] = new \ArrayIterator(\Dash\values(\Dash\toArray($arg)));
		}
	}

	while (true) {
		$row = [];

		foreach ($iters as $it) {
			if (!$it->valid()) {
				return;
			}

			$row[] = $it->current();
		}

		yield $row;

		foreach ($iters as $it) {
			$it->next();
		}
	}
}
