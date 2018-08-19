<?php

namespace Dash\Curry;

function assertType(/* $type, $funcName, input */)
{
	return \Dash\currify('Dash\assertType', func_get_args());
}
