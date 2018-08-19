<?php

namespace Dash\Curry;

function getDirect(/* $key, $default, $iterable */)
{
	return \Dash\currify('Dash\getDirect', func_get_args());
}
