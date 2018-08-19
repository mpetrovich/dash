<?php

namespace Dash\Curry;

function first(/* $iterable */)
{
	return \Dash\currify('Dash\first', func_get_args());
}

function head(/* $iterable */)
{
	return \Dash\currify('Dash\first', func_get_args());
}
