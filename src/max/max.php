<?php

namespace Dash;

function max($collection)
{
	if (isEmpty($collection)) {
		return null;
	}

	$max = reduce($collection, function($max, $value) {
		return \max($max, $value);
	}, -INF);

	return $max;
}
