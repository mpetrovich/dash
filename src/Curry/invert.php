<?php

namespace Dash\Curry;

function invert(/* $iterable */)
{
	return \Dash\currify('Dash\invert', func_get_args());
}

function invertObj(/* $iterable */)
{
	return \Dash\currify('Dash\invert', func_get_args());
}
