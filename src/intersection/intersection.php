<?php

namespace Dash;

function intersection($iterables /* or as $iterable1, $iterable2, ... */)
{
	if (func_num_args() > 1) {
		$iterables = func_get_args();
	}

	$intersection = array_shift($iterables);

	foreach ($iterables as $iterable) {
		foreach ($intersection as $key => $value) {
			if (!contains($iterable, $value)) {
				// @todo Test whether unset() works with all Traversable
				unset($intersection[$key]);
			}
		}
	}

	$intersection = values($intersection);  // Re-indexes due to unset() holes

	return $intersection;
}
