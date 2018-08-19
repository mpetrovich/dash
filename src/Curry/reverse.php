<?php

namespace Dash\Curry;

function reverse(/* $preserveIntegerKeys, iterable */)
{
	return \Dash\currify('Dash\reverse', func_get_args());
}
