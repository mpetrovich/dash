<?php

namespace Dash\Generator;

/**
 * @see Dash\zipAll()
 */
// @codingStandardsIgnoreLine
function zipAll(/* ...$iterables */)
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
		$anyValid = false;

		foreach ($iters as $it) {
			if ($it->valid()) {
				$row[] = $it->current();
				$anyValid = true;
			}
			else {
				$row[] = null;
			}
		}

		if (!$anyValid) {
			return;
		}

		yield $row;

		foreach ($iters as $it) {
			if ($it->valid()) {
				$it->next();
			}
		}
	}
}
