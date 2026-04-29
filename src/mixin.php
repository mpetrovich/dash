<?php

namespace Dash;

/**
 * Alias of `setCustom()`.
 *
 * @param string $name
 * @param callable $callable
 * @return void
 */
function mixin($name, callable $callable)
{
	setCustom($name, $callable);
}
