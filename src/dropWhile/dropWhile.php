<?php

namespace Dash;

function dropWhile($input, $predicate = 'Dash\identity')
{
	assertType($input, ['iterable']);

	$keys = [];
	$done = false;

	foreach ($input as $key => $value) {
		if (!$done && call_user_func($predicate, $value, $key)) {
			continue;
		}
		else {
			$done = true;
			$keys[] = $key;
		}
	}

	return pick($input, $keys);
}
