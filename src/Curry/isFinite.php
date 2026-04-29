<?php

namespace Dash\Curry;

function isFinite(/* $value */)
{
	return \Dash\currify('Dash\isFinite', func_get_args());
}
