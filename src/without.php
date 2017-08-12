<?php

namespace Dash;

function without($collection, $excluded, $predicate = null)
{
	if ($predicate === null) {
		$predicate = 'Dash\equal';
	}

	$without = reject($collection, function($value) use ($excluded, $predicate) {
		return contains($excluded, $value, $predicate);
	});

	return $without;
}
