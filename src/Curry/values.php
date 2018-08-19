<?php

namespace Dash\Curry;

function values(/* $iterable */)
{
	return \Dash\currify('Dash\values', func_get_args());
}
