<?php

namespace Dash;

function keyBy($input, $keyBy = 'Dash\identity')
{
	assertType($input, ['array', 'object']);

	return reduce($input, function($grouped, $value) use ($keyBy) {
		$key = get($value, $keyBy);
		$grouped[$key] = $value;
		return $grouped;
	});
}
