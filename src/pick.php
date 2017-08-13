<?php

namespace Dash;

function pick($input, $keys)
{
	assertType($input, ['iterable']);

	$keys = (array) $keys;
	$picked = [];

	foreach ($input as $key => $value) {
		if (in_array($key, $keys)) {
			$picked[$key] = $value;
		}
	}

	return is_object($input) ? (object) $picked : $picked;
}
