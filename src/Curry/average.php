<?php

namespace Dash\Curry;

function average(/* $iterable */)
{
	return \Dash\currify('Dash\average', func_get_args());
}

function mean(/* $iterable */)
{
	return call_user_func_array('Dash\Curry\average', func_get_args());
}
