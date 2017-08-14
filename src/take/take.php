<?php

namespace Dash;

function take($collection, $count = 1, $fromStart = 0)
{
	$taken = [];

	foreach ($collection as $key => $value) {
		if ($fromStart > 0) {
			$fromStart--;
			continue;
		}
		if ($count <= 0) {
			break;
		}
		$count--;

		$taken[$key] = $value;
	}

	return $taken;
}
