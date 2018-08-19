<?php

namespace Dash\Curry;

function size(/* $value */)
{
	return \Dash\currify('Dash\size', func_get_args());
}

function count(/* $value */)
{
	return call_user_func_array('Dash\Curry\size', func_get_args());
}
