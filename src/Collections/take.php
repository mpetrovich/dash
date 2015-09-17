<?php

namespace Dash\Collections;

function take($collection, $count = 1, $fromStart = 0)
{
	$taken = array();

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
