<?php

namespace Dash\Curry;

function min(/* $iterable */)
{
	return \Dash\currify('Dash\min', func_get_args());
}
