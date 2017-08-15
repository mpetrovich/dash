<?php

namespace Dash;

function min($iterable)
{
	if (isEmpty($iterable)) {
		return null;
	}

	$min = reduce($iterable, function($min, $value) {
		return \min($min, $value);
	}, +INF);

	return $min;
}
