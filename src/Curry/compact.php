<?php

namespace Dash\Curry;

function compact(/* $iterable */)
{
	return \Dash\currify('Dash\compact', func_get_args());
}
