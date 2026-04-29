<?php

namespace Dash;

/**
 * Alias of `setCustom()`.
 *
 * @category Utilities & misc
 *
 * @param string $name
 * @param callable $callable
 * @return void
 *
 * @example
	Dash\mixin('double', function ($n) { return $n * 2; });

	Dash\Dash::double(6);
	// === 12
 */
function mixin($name, callable $callable)
{
	setCustom($name, $callable);
}
