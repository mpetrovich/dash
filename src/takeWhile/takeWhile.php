<?php

namespace Dash;

function takeWhile($input, $predicate = 'Dash\identity')
{
	assertType($input, ['iterable']);

	$keys = [];

	foreach ($input as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			$keys[] = $key;
		}
		else {
			break;
		}
	}

	return pick($input, $keys);
}
