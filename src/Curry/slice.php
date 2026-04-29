<?php

namespace Dash\Curry;

function slice(/* $offset, $length, $iterable */)
{
	return \Dash\currify('Dash\slice', func_get_args());
}
