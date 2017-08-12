<?php

namespace Dash;

function deltas($collection)
{
	$deltas = [];
	$prev = null;

	foreach ($collection as $value) {
		$deltas[] = $prev ? ($value - $prev) : 0;
		$prev = $value;
	}

	return $deltas;
}
