<?php

namespace Dash;

function min($collection)
{
	if (isEmpty($collection)) {
		return null;
	}

	$min = reduce($collection, function($min, $value) {
		return \min($min, $value);
	}, +INF);

	return $min;
}
