<?php

namespace Dash;

/**
 * Checks whether a value exists at `$path` within `$input`.
 *
 * Unlike `hasDirect()`, this supports nested paths (dot notation) via `property()`.
 *
 * @category Objects & paths
 *
 * @see get(), hasDirect(), property()
 *
 * @param mixed $input
 * @param callable|string|integer $path
 * @return boolean
 *
 * @example
	Dash\has(['user' => ['name' => 'Ann']], 'user.name');
	// === true

	Dash\has(['user' => []], 'user.name');
	// === false
 */
function has($input, $path)
{
	if (is_null($input)) {
		return false;
	}

	if (hasDirect($input, $path)) {
		return true;
	}

	$sentinel = new \stdClass();
	return get($input, $path, $sentinel) !== $sentinel;
}
