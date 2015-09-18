<?php

namespace Dash\Collections;

function union($collections /* or as $collection1, $collection2, ... */)
{
	if (func_num_args() > 1) {
		$collections = func_get_args();
	}

	$union = array();

	foreach ($collections as $collection) {
		foreach ($collection as $value) {
			if (!contains($union, $value)) {
				$union[] = $value;
			}
		}
	}

	return $union;
}