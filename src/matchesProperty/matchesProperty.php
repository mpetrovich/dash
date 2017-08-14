<?php

namespace Dash;

function matchesProperty($path, $value)
{
	$matches = function($collection) use ($path, $value) {
		return get($collection, $path) == $value;
	};

	return $matches;
}
