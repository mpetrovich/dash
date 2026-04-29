<?php

namespace Dash\Curry;

function pop(/* $iterable */)
{
	return \Dash\currify('Dash\pop', func_get_args());
}
