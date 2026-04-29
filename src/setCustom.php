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
 *
 * @example
	Dash\setCustom('triple', function ($n) { return $n * 3; });

	Dash\Dash::triple(4);
	// === 12
 */
function setCustom($name, callable $callable)
{
	Dash::setCustom($name, $callable);
}
