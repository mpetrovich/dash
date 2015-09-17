<?php

namespace Dash\Collections;

function intersection($collections /* or as $collection1, $collection2, ... */)
{
	if (func_num_args() > 1) {
		$collections = func_get_args();
	}

	$intersection = array_shift($collections);

	foreach ($collections as $collection) {
		foreach ($intersection as $key => $value) {
			if (!contains($collection, $value)) {
				// @todo Test whether unset() works with all Traversable
				unset($intersection[$key]);
			}
		}
	}

	$intersection = values($intersection);  // Re-indexes due to unset() holes

	return $intersection;
}
