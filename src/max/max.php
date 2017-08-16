<?php

namespace Dash;

function max($iterable)
{
	if (isEmpty($iterable)) {
		return null;
	}

	$max = reduce($iterable, function ($max, $value) {
		return \max($max, $value);
	}, -INF);

	return $max;
}
