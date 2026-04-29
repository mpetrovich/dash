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
 */
function mixin($name, callable $callable)
{
	setCustom($name, $callable);
}
