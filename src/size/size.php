<?php

namespace Dash;

function size($input, $encoding = 'utf8')
{
	if (is_array($input) || $input instanceof Countable) {
		$size = count($input);
	}
	elseif (is($input, 'iterable')) {
		$size = 0;
		foreach ($input as $value) {
			$size++;
		}
	}
	elseif (is_string($input)) {
		$size = mb_strlen($input, $encoding);
	}
	else {
		$size = null;
	}

	return $size;
}
