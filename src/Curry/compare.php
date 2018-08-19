<?php

namespace Dash\Curry;

function compare(/* $b, $a */)
{
	return \Dash\currify('Dash\compare', func_get_args());
}
