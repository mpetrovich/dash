<?php

namespace Dash\Curry;

function hasDirect(/* $key, $input */)
{
	return \Dash\currify('Dash\hasDirect', func_get_args());
}
