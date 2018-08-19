<?php

namespace Dash\Curry;

function take(/* $count, $iterable */)
{
	return \Dash\currify('Dash\take', func_get_args());
}
