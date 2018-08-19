<?php

namespace Dash\Curry;

function isEmpty(/* $value */)
{
	return \Dash\currify('Dash\isEmpty', func_get_args());
}
