<?php

namespace Dash\Curry;

function join(/* $separator, $iterable */)
{
	return \Dash\currify('Dash\join', func_get_args());
}

function implode(/* $separator, $iterable */)
{
	return call_user_func_array('Dash\Curry\join', func_get_args());
}
