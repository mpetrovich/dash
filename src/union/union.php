<?php

namespace Dash;

function union($iterables)
{
	if (func_num_args() > 1) {
		$iterables = func_get_args();
	}

	$union = [];

	foreach ($iterables as $iterable) {
		foreach ($iterable as $value) {
			if (!contains($union, $value)) {
				$union[] = $value;
			}
		}
	}

	return $union;
}
