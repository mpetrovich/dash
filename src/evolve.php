<?php

namespace Dash;

/**
 * Returns a new copy of `$input` with transformations applied at matching top-level keys.
 *
 * v1 applies only one level deep.
 *
 * @param iterable|stdClass|null $input
 * @param array $transformations
 * @return array|object
 */
function evolve($input, array $transformations)
{
	assertType($input, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (is_null($input)) {
		return [];
	}

	$isObject = isType($input, 'stdClass');
	$result = toArray($input);

	foreach ($result as $key => $value) {
		if (array_key_exists($key, $transformations) && is_callable($transformations[$key])) {
			$result[$key] = call_user_func($transformations[$key], $value);
		}
	}

	return $isObject ? toObject($result) : $result;
}
