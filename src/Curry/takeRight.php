<?php

namespace Dash\Curry;

function takeRight(/* $count, $iterable */)
{
	return \Dash\currify('Dash\takeRight', func_get_args());
}
