<?php

namespace Dash\Curry;

function product(/* $iterable */)
{
	return \Dash\currify('Dash\product', func_get_args());
}
