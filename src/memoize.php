<?php

namespace Dash;

/**
 * Creates a memoized version of `$callable`.
 *
 * Results are cached by argument values.
 *
 * @category Functions & composition
 *
 * @param callable $callable
 * @return callable
 */
function memoize(callable $callable)
{
	$cache = [];

	return function () use ($callable, &$cache) {
		$args = func_get_args();
		$keyParts = [];

		foreach ($args as $arg) {
			if (is_null($arg) || is_scalar($arg)) {
				$keyParts[] = gettype($arg) . ':' . (string) $arg;
			}
			elseif (is_resource($arg)) {
				$keyParts[] = 'resource:' . get_resource_id($arg);
			}
			elseif (is_object($arg)) {
				$keyParts[] = 'object:' . spl_object_id($arg);
			}
			else {
				$keyParts[] = 'array:' . serialize($arg);
			}
		}

		$key = \implode('|', $keyParts);

		if (!array_key_exists($key, $cache)) {
			$cache[$key] = call_user_func_array($callable, $args);
		}

		return $cache[$key];
	};
}
