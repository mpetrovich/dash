<?php

namespace Dash\Curry;

function isEven(/* $value */)
{
	return \Dash\currify('Dash\isEven', func_get_args());
}
