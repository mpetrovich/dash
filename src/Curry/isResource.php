<?php

namespace Dash\Curry;

function isResource(/* $value */)
{
	return \Dash\currify('Dash\isResource', func_get_args());
}
