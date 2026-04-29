<?php

namespace Dash\Curry;

function sample(/* $iterable */)
{
	return \Dash\currify('Dash\sample', func_get_args());
}
