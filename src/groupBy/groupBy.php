<?php

namespace Dash;

function groupBy($input, $groupBy, $defaultGroup = null)
{
	assertType($input, ['iterable']);

	return reduce($input, function ($grouped, $value) use ($groupBy, $defaultGroup) {
		$key = get($value, $groupBy);
		$key = is_null($key) ? $defaultGroup : $key;
		$grouped[$key][] = $value;
		return $grouped;
	});
}
