<?php

namespace Dash;

function deltas($iterable)
{
	$deltas = [];
	$prev = null;

	foreach ($iterable as $value) {
		$deltas[] = $prev ? ($value - $prev) : 0;
		$prev = $value;
	}

	return $deltas;
}
