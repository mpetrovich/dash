<?php

namespace Dash\Curry;

function pick(/* $keys, $iterable */)
{
	return \Dash\currify('Dash\pick', func_get_args());
}
