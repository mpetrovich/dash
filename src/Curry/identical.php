<?php

namespace Dash\Curry;

function identical(/* $b, $a */)
{
	return \Dash\currify('Dash\identical', func_get_args());
}
