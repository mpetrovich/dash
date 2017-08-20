<?php

namespace Dash;

function reject($iterable, $predicate)
{
	if (empty($iterable)) {
		return [];
	}

	$predicate = is_callable($predicate) ? $predicate : matchesProperty($predicate, true);

	return filter($iterable, negate($predicate));
}
