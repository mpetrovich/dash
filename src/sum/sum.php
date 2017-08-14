<?php

namespace Dash;

function sum($collection)
{
	$sum = reduce($collection, function($sum, $value) {
		return $sum += $value;
	}, 0);

	return $sum;
}
