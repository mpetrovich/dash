<?php

namespace Dash\Curry;

function max(/* $iterable */)
{
	return \Dash\currify('Dash\max', func_get_args());
}
