<?php

namespace Dash\Curry;

function drop(/* $count, $iterable */)
{
	return \Dash\currify('Dash\drop', func_get_args());
}
