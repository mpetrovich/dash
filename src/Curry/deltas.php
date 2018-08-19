<?php

namespace Dash\Curry;

function deltas(/* $iterable */)
{
	return \Dash\currify('Dash\deltas', func_get_args());
}
