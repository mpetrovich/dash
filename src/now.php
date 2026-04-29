<?php

namespace Dash;

/**
 * Returns the current UNIX timestamp in milliseconds.
 *
 * @category Utilities & misc
 *
 * @return integer
 *
 * @example
	Dash\now();  // milliseconds since Unix epoch, e.g. 1714419200123
 */
function now()
{
	return (int) floor(microtime(true) * 1000);
}
