<?php

namespace Dash;

/**
 * Returns the current UNIX timestamp in milliseconds.
 *
 * @category Utilities & misc
 *
 * @return integer
 */
function now()
{
	return (int) floor(microtime(true) * 1000);
}
