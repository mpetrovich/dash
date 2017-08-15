<?php

namespace Dash;

function without($iterable, $excluded, $predicate = null)
{
	if ($predicate === null) {
		$predicate = 'Dash\equal';
	}

	$without = reject($iterable, function($value) use ($excluded, $predicate) {
		return contains($excluded, $value, $predicate);
	});

	return $without;
}
