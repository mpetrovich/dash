<?php

namespace Dash;

function average($collection)
{
	$size = size($collection);

	if ($size === 0) {
		return 0;
	}
	else {
		return sum($collection) / $size;
	}
}
