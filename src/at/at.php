<?php

namespace Dash;

function at($iterable, $index)
{
	$at = null;

	$i = 0;
	foreach ($iterable as $key => $value) {
		$at = $value;
		if ($i === intval($index)) {
			break;
		}
		$i++;
	}

	return $at;
}
