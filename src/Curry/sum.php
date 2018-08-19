<?php

namespace Dash\Curry;

function sum(/* $iterable */)
{
	return \Dash\currify('Dash\sum', func_get_args());
}
