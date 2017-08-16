<?php

namespace Dash;

function keyBy($input, $keyBy = 'Dash\identity')
{
	assertType($input, ['iterable']);

	return reduce($input, function ($grouped, $value) use ($keyBy) {
		$key = get($value, $keyBy);
		$grouped[$key] = $value;
		return $grouped;
	});
}
