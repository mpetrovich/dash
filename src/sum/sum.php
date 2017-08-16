<?php

namespace Dash;

function sum($iterable)
{
	$sum = reduce($iterable, function ($sum, $value) {
		return $sum += $value;
	}, 0);

	return $sum;
}
