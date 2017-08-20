<?php

namespace Dash;

function result($input, $path, $default = null)
{
	$value = get($input, $path, $default);

	if (is_callable($value)) {
		$value = call_user_func($value);
	}

	return $value;
}
