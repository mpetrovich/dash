<?php

namespace Dash\Curry;

function without(/* $exclude, $iterable */)
{
	return \Dash\currify('Dash\without', func_get_args());
}
