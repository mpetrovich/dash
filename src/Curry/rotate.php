<?php

namespace Dash\Curry;

function rotate(/* $count, $iterable */)
{
	return \Dash\currify('Dash\rotate', func_get_args());
}
