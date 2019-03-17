<?php

namespace Dash;

/**
 * Gets a custom operation by name.
 *
 * @param string $name Name of the custom operation
 * @return function The custom operation
 *
 * @example
	_::setCustom('double', function ($n) { return $n * 2; });

	$double = Dash\custom('double');
	$double(3);
	// === 6

	_::chain([1, 2, 3])->map(Dash\custom('double'))->value();
	// === [2, 4, 6]
 */
function custom($name)
{
	return Dash::getCustom($name);
}
