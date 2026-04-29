<?php

namespace Dash\Curry;

function flattenDeep(/* $iterable */)
{
	return \Dash\currify('Dash\flattenDeep', func_get_args());
}
