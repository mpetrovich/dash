<?php

namespace Dash\Curry;

/**
 * @codingStandardsIgnoreStart
 * @codeCoverageIgnore Due to output buffering
 */
function debug(/* ...value */)
{
	return \Dash\currify('Dash\debug', func_get_args());
}
