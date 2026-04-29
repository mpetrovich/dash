<?php

namespace Dash\Curry;

function initial(/* $iterable */)
{
	return \Dash\currify('Dash\initial', func_get_args());
}

function init(/* $iterable */)
{
	return \Dash\currify('Dash\initial', func_get_args());
}
