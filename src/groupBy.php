<?php

namespace Dash;

function groupBy($input, $groupBy)
{
	assertType($input, ['array', 'object']);

	return reduce($input, function($grouped, $value) use ($groupBy) {
		$key = get($value, $groupBy);
		$grouped[$key][] = $value;
		return $grouped;
	});
}
