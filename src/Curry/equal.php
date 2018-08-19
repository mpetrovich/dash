<?php

namespace Dash\Curry;

function equal(/* $b, $a */)
{
	return \Dash\currify('Dash\equal', func_get_args());
}
