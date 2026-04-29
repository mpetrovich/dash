<?php

namespace Dash\Curry;

function chunk(/* $size, $iterable */)
{
	return \Dash\currify('Dash\chunk', func_get_args());
}

function splitEvery(/* $size, $iterable */)
{
	return \Dash\currify('Dash\chunk', func_get_args());
}
