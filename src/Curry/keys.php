<?php

namespace Dash\Curry;

function keys(/* $iterable */)
{
	return \Dash\currify('Dash\keys', func_get_args());
}
