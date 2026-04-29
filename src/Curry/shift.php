<?php

namespace Dash\Curry;

function shift(/* $iterable */)
{
	return \Dash\currify('Dash\shift', func_get_args());
}
