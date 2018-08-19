<?php

namespace Dash\Curry;

function omit(/* $keys, $iterable */)
{
	return \Dash\currify('Dash\omit', func_get_args());
}
