<?php

namespace Dash;

/**
 * Sets a custom Dash operation.
 *
 * @category Utilities & misc
 *
 * @param string $name
 * @param callable $callable
 * @return void
 */
function setCustom($name, callable $callable)
{
	Dash::setCustom($name, $callable);
}
