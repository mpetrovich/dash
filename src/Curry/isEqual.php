<?php

namespace Dash\Curry;

function isEqual(/* $b, $a */)
{
	return \Dash\currify('Dash\isEqual', func_get_args());
}
