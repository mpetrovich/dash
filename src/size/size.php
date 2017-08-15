<?php

namespace Dash;

function size($iterable)
{
	if (is_array($iterable) || $iterable instanceof Countable) {
		return count($iterable);
	}
	else {
		$count = 0;
		foreach ($iterable as $value) {
			$count++;
		}
		return $count;
	}
}
