<?php

namespace Dash;

function matchesProperty($path, $value)
{
	$matches = function ($iterable) use ($path, $value) {
		return get($iterable, $path) == $value;
	};

	return $matches;
}
