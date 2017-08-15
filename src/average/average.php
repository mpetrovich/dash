<?php

namespace Dash;

function average($iterable)
{
	$size = size($iterable);

	if ($size === 0) {
		return 0;
	}
	else {
		return sum($iterable) / $size;
	}
}
