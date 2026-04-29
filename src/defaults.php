<?php

namespace Dash;

/**
 * Fills missing or null keys in `$input` from sources, left to right.
 *
 * The first non-null source value for a key wins.
 *
 * @param iterable|stdClass|null $input
 * @return array
 */
function defaults($input /*, ...$sources */)
{
	assertType($input, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$result = toArray($input);
	$sources = array_slice(func_get_args(), 1);

	foreach ($sources as $source) {
		assertType($source, ['iterable', 'stdClass', 'null'], __FUNCTION__);

		foreach (toArray($source) as $key => $value) {
			$needsDefault = !array_key_exists($key, $result) || is_null($result[$key]);
			$hasDefault = !is_null($value);

			if ($needsDefault && $hasDefault) {
				$result[$key] = $value;
			}
		}
	}

	return $result;
}
