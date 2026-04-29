<?php

namespace Dash\Curry;

function tail(/* $iterable */)
{
	return \Dash\currify('Dash\tail', func_get_args());
}

function rest(/* $iterable */)
{
	return \Dash\currify('Dash\tail', func_get_args());
}
